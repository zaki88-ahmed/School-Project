import React, { Component } from "react"
import PropTypes from "prop-types"

import { disableBodyScroll, clearAllBodyScrollLocks } from "body-scroll-lock"
import { Link } from "react-router-dom"

import styles from "./LibraryResultsElementor.module.css"
import LibrarySearchElementorFilters from "../LibrarySearchElementorFilters"

import ItemResults from "./ItemResults"

export default class LibraryResultsElementor extends Component {
  constructor(props) {
    super(props)
    this.groupRef = null
    this.state = {
      isOpen: false,
      ignorePluginWarnings: false,
    }
  }

  shouldComponentUpdate(nextProps, nextState) {
    // always update if the screensize changes
    if (this.props.getModalPos !== nextProps.getModalPos) {
      return true
    }
    if (this.state.ignorePluginWarnings !== nextState.ignorePluginWarnings) {
      return true
    }
    // Only update if the open state changes of a template
    if (this.props.openItem !== nextProps.openItem) {
      return true
    }
    // Update if import finishes
    // todo: this doesn't work for some reason, investigate why a window resize triggers an update but this doesn.t
    if (JSON.stringify(this.props.result.templates) !== JSON.stringify(nextProps.result.templates)) {
      return true
    }
    return false
  }

  componentDidUpdate(prevProps) {
    // Toggle scroll locking of the open item status.
    const { openItem } = this.props
    const { isOpen } = this.state
    if (openItem && !isOpen) {
      this.setState({ isOpen: true })
      disableBodyScroll(this.groupRef)
    } else if (prevProps.openItem && !openItem) {
      this.setState({ isOpen: false })
      setTimeout(() => {
        clearAllBodyScrollLocks()
      }, 100)
    }
  }

  componentWillUnmount() {
    clearAllBodyScrollLocks()
  }

  setIgnorePluginWarnings = () => {
    this.setState({ ignorePluginWarnings: true })
  }

  render() {
    const { result, openItem, getModalPos, searchQuery, searchChanges } = this.props
    const { ignorePluginWarnings } = this.state

    // searching or browsing.
    if (searchQuery.text && searchQuery.text.length > 0) {
      // if we're searching free text, show all thumbnails.
      return (
        <React.Fragment>
          {result.templates.map((template) => {
            return <ItemResults key={template.templateId} fromSearch template={template} {...this.props} />
          })}
        </React.Fragment>
      )
    }

    if (openItem && openItem.collectionId) {
      // opening a full item or a full collection:
      return (
        <div
          className={styles.open}
          style={getModalPos}
          ref={(ref) => {
            this.groupRef = ref
          }}>
          <div className={styles.openTitle}>
            <Link
              className={styles.returnToIndex}
              to={`/${result.categorySlug}`}
              onClick={(e) => {
                e.preventDefault()
                searchQuery.collectionId = null
                searchChanges(searchQuery)
                // window.history.back()
                return false
              }}>
              Back to Elementor Templates
            </Link>
          </div>
          <div className={styles.openContent}>
            <div className={styles.openContentWelcome}>
              <h3 className={styles.openContentTitle}>{result.collectionName}</h3>
              {result.templates.length} Page Templates in this Kits
            </div>
            <div className={styles.openContentFilter}>
              <LibrarySearchElementorFilters
                allowPremium
                searchFilterChange={(key, value, set) => {
                  searchQuery[key] = set ? value : null
                  searchChanges(searchQuery)
                }}
                searchQuery={searchQuery}
              />
            </div>
            <div className={styles.openContentResults}>
              {result.templates.map((template) => {
                return (
                  <ItemResults
                    key={template.templateId}
                    template={template}
                    ignorePluginWarnings={ignorePluginWarnings}
                    setIgnorePluginWarnings={this.setIgnorePluginWarnings}
                    {...this.props}
                  />
                )
              })}
            </div>
          </div>
        </div>
      )
    }
    // otherwise by default just group them by template kit, pass in `summary` flag so we adjust the title.
    return <ItemResults key={result.collectionId} summary template={result.templates[0]} {...this.props} />
  }
}

LibraryResultsElementor.propTypes = {
  openItem: PropTypes.shape({}),
  result: PropTypes.shape({
    categorySlug: PropTypes.string,
    collectionName: PropTypes.string,
    features: PropTypes.shape({
      premium: PropTypes.string,
      new: PropTypes.string,
    }),
    collectionId: PropTypes.string,
    templates: PropTypes.arrayOf(
      PropTypes.shape({
        templateId: PropTypes.string,
      }),
    ),
  }).isRequired,
  getModalPos: PropTypes.shape({}).isRequired,
  searchQuery: PropTypes.shape({}).isRequired,
  searchChanges: PropTypes.func.isRequired,
}

LibraryResultsElementor.defaultProps = {
  openItem: null,
}
