import React, { Component } from "react"
import PropTypes from "prop-types"

import { LazyLoadComponent, trackWindowScroll } from "react-lazy-load-image-component"
import { disableBodyScroll, enableBodyScroll, clearAllBodyScrollLocks } from "body-scroll-lock"
import $ from "jquery"
import { Link } from "react-router-dom"
import LicenseButton from "./LicenseButton"

import styles from "./LibraryResultsBeaverBuilder.module.css"
import stylesShared from "../shared.module.css"
import Importer from "./Importer"

const LibraryResultsItem = ({
  summary,
  fromSearch,
  result,
  template,
  scrollPosition,
  layoutOptions,
  openItem,
  getModalPos,
  updateSingleItem,
  searchChanges,
  ignorePluginWarnings,
  setIgnorePluginWarnings,
}) => {
  let imagePlaceHolder = null
  return (
    <LazyLoadComponent scrollPosition={scrollPosition} placeholder={<div className={styles.squareWrapLoading} />}>
      <div
        className={`${styles.squareWrap} ${template.itemImported ? styles.imported : ""} ${
          template.templateInserted && template.templateInserted.length > 0 ? styles.imported : ""
        } ${summary ? styles.squareSummary : ""}`}>
        {openItem && openItem.templateId === template.templateId ? (
          <div className={styles.itemOpen} style={getModalPos}>
            <div className={styles.itemOpenTitle}>
              <Link
                to={`/${result.categorySlug}?collectionId=${result.collectionId}`}
                className={styles.returnToIndex}
                onClick={(e) => {
                  e.preventDefault()
                  window.history.back()
                  return false
                }}>
                {fromSearch ? "Back to Beaver Builder Templates" : `Back to Template Kit`}
              </Link>
            </div>
            <div className={styles.itemOpenContent}>
              <div className={styles.itemOpenContentWelcome}>
                <h3 className={styles.itemOpenContentTitle}>
                  {result.collectionName} - {template.templateName}
                </h3>
              </div>
              <div className={styles.itemOpenItem}>
                <div
                  className={styles.imagePlaceHolder}
                  style={{
                    backgroundImage: `url( ${template.previewThumb} )`,
                    height: `${template.largeThumb.height}px`,
                    maxWidth: `${template.largeThumb.width}px`,
                  }}
                  ref={(ref) => (imagePlaceHolder = ref)}>
                  <div className={styles.features}>
                    {template.itemImported ? (
                      <span className={styles.featureImported}>Imported</span>
                    ) : template.templateInserted && template.templateInserted.length > 0 ? (
                      <span className={styles.featureImported}>Imported</span>
                    ) : (
                      ""
                    )}
                    {template.templateFeatures
                      ? Object.entries(template.templateFeatures).map((feature) => (
                          <span key={feature[0]} className={styles.featureOther}>
                            {feature[1].small}
                          </span>
                        ))
                      : ""}
                  </div>
                  <img
                    src={template.largeThumb.src}
                    width={template.largeThumb.width}
                    height={template.largeThumb.height}
                    alt={template.templateName}
                    className={styles.itemOpenItemSrc}
                    onLoad={() => {
                      imagePlaceHolder.className = `${imagePlaceHolder.className} ${styles.imagePlaceHolderLoaded}`
                    }}
                  />
                </div>
              </div>
              <div className={styles.itemOpenOptions}>
                <div className={styles.openFeatures}>
                  <ul className={stylesShared.bullets}>
                    <li>
                      <strong>Plugin Requirements:</strong>
                      <br />
                      Works fine with Beaver Builder Free
                    </li>
                    <li>
                      <strong>Commercial License:</strong>
                      <br />
                      <a
                        href="https://elements.envato.com/user-terms/?utm_source=extensions&utm_medium=referral&utm_campaign=wordpress_item"
                        target="_blank"
                        rel="noopener noreferrer">
                        This template is free to use.
                      </a>
                    </li>
                  </ul>
                </div>
                {!ignorePluginWarnings && template.missingPlugins.length ? (
                  <React.Fragment>
                    <h3 className={styles.itemOpenOptionsTitle}>Required Plugins Missing</h3>
                    {template.missingPlugins.map((plugin) => {
                      return (
                        <div className={styles.itemOpenItemDescription} key={plugin.slug}>
                          <p>To use this template please ensure all required plugins are installed and active.</p>
                          <a href={plugin.url} className={stylesShared.button} target="_blank">
                            {plugin.text}
                          </a>
                        </div>
                      )
                    })}
                  </React.Fragment>
                ) : (
                  <React.Fragment>
                    <div className={styles.itemOpenOptionsBlock}>
                      <h3 className={styles.itemOpenOptionsTitle}>Create Page from Template</h3>
                      <div className={styles.itemOpenItemDescription}>
                        Create a new page from this template to make it available as a draft page in your Pages list.
                      </div>
                      <Importer
                        updateSingleItem={updateSingleItem}
                        category="beaver-builder"
                        item={template}
                        createPage
                        importData={{
                          collectionId: result.collectionId,
                          templateId: template.templateId,
                          importType: "create-page",
                        }}
                        label="Create Page"
                      />
                    </div>
                  </React.Fragment>
                )}
              </div>
            </div>
          </div>
        ) : (
          ""
        )}
        <div className={styles.inner} style={{ backgroundImage: `url( ${template.previewThumb} )` }}>
          {!summary ? (
            <div className={styles.features}>
              {template.itemImported ? (
                <span className={styles.featureImported}>Imported</span>
              ) : template.templateInserted && template.templateInserted.length > 0 ? (
                <span className={styles.featureImported}>Imported</span>
              ) : (
                ""
              )}
              {template.templateFeatures
                ? Object.entries(template.templateFeatures).map((feature) => (
                    <span key={feature[0]} className={styles.featureOther}>
                      {feature[1].small}
                    </span>
                  ))
                : ""}
            </div>
          ) : (
            <div className={styles.features}>
              {result.features
                ? Object.entries(result.features).map((feature) => (
                    <span key={feature[0]} className={`${styles.featureOther} ${styles[`featureOther${feature[0]}`]}`}>
                      {feature[1]}
                    </span>
                  ))
                : ""}
            </div>
          )}
          <Link
            to={`/${result.categorySlug}?collectionId=${result.collectionId}${
              !summary ? `&templateId=${template.templateId}` : ""
            }`}
            onClick={(e) => {
              e.preventDefault()
              searchChanges({ collectionId: result.collectionId, templateId: !summary ? template.templateId : null })
              return false
            }}
            className={styles.thumb}>
            &nbsp;
          </Link>
        </div>
        <div className={styles.details}>
          {summary ? (
            <div className={styles.detailsItemName}>
              <h3 className={styles.detailsItemNameTitle}>{result.collectionName}</h3>
              {result.templates.length} Page Templates in this Kits
            </div>
          ) : fromSearch ? (
            <div className={styles.detailsItemName}>
              <h3 className={styles.detailsItemNameTitle}>{result.collectionName}</h3>
              {template.templateName}
            </div>
          ) : (
            <div className={styles.detailsItemName}>
              <h3 className={styles.detailsItemNameTitle}>{template.templateName}</h3>
            </div>
          )}
        </div>
      </div>
    </LazyLoadComponent>
  )
}

const ItemResults = trackWindowScroll(LibraryResultsItem)

export default class LibraryResultsBeaverBuilder extends Component {
  constructor(props) {
    super(props)
    this.groupRef = null
    this.state = {
      hasIndexLoaded: true,
      isOpen: false,
      ignorePluginWarnings: false,
    }
  }

  componentDidMount() {
    const { openItem } = this.props
    const { isOpen } = this.state
    // if (openItem && !isOpen) {
    //   this.state.hasIndexLoaded = false
    //
    //   this.forceUpdate()
    // }
  }

  shouldComponentUpdate(nextProps, nextState) {
    // always update if the screensize changes
    if (this.props.getModalPos !== nextProps.getModalPos) {
      return true
    }
    if (this.state.ignorePluginWarnings !== nextState.ignorePluginWarnings) {
      return true
    }
    // Update if import finishes
    // todo: this doesn't work for some reason, investigate why a window resize triggers an update but this doesn.t
    if (JSON.stringify(this.props.result.templates) !== JSON.stringify(nextProps.result.templates)) {
      return true
    }
    // Only update if the open state changes of a template
    if (this.props.openItem !== nextProps.openItem) {
      return true
    }
    return false
  }

  componentDidUpdate(prevProps, prevState) {
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
    const { result, openItem, getModalPos, searchQuery } = this.props
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
        <div className={styles.open} style={getModalPos} ref={(ref) => (this.groupRef = ref)}>
          <div className={styles.openTitle}>
            <Link
              className={styles.returnToIndex}
              to={`/${result.categorySlug}`}
              onClick={(e) => {
                e.preventDefault()
                window.history.back()
                return false
              }}>
              Back to Beaver Builder Templates
            </Link>
          </div>
          <div className={styles.openContent}>
            <div className={styles.openContentWelcome}>
              <h3 className={styles.openContentTitle}>{result.collectionName}</h3>
              {result.templates.length} Page Templates in this Kits
            </div>
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
      )
    }
    // otherwise by default just group them by template kit, pass in `summary` flag so we adjust the title.
    return <ItemResults key={result.collectionId} summary template={result.templates[0]} {...this.props} />
  }
}

LibraryResultsBeaverBuilder.propTypes = {}
