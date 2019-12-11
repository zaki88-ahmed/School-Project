import React, { Component } from "react"
import PropTypes from "prop-types"

import { disableBodyScroll, enableBodyScroll, clearAllBodyScrollLocks } from "body-scroll-lock"
import $ from "jquery"
import { Link } from "react-router-dom"
import { LazyLoadComponent, trackWindowScroll } from "react-lazy-load-image-component"
import LicenseButton from "./LicenseButton"
import Importer from "./Importer"
import Inserter from "./Inserter"

import styles from "./LibraryResultsElementorBlocks.module.css"
import stylesShared from "../shared.module.css"
import { config } from "../util/config"

const LibraryResultsItem = ({
  summary,
  fromSearch,
  result,
  template,
  scrollPosition,
  layoutOptions,
  getModalPos,
  updateSingleItem,
  ignorePluginWarnings,
  setIgnorePluginWarnings,
}) => {
  let imagePlaceHolder = null
  const needsElementorPro = !!template.templateFeatures["elementor-pro"]
  return (
    <LazyLoadComponent scrollPosition={scrollPosition} placeholder={<div className={styles.blockWrapLoading} />}>
      <div
        className={`${styles.blockWrap} ${template.itemImported ? styles.imported : ""} ${
          template.templateInserted && template.templateInserted.length > 0 ? styles.imported : ""
        } ${fromSearch ? styles.squareFromSearch : ""}`}>
        <div className={styles.thumbnail}>
          <div
            className={styles.imagePlaceHolder}
            style={{
              // backgroundImage: `url( ${template.previewThumb} )`,
              height: `${template.largeThumb.height}px`,
              maxWidth: `${template.largeThumb.width}px`,
            }}
            ref={(ref) => (imagePlaceHolder = ref)}>
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
        <div className={styles.details}>
          <h3 className={styles.itemOpenItemName}>{template.templateName}</h3>
          <div className={styles.openFeatures}>
            <ul className={stylesShared.bullets}>
              <li>
                <strong>Plugin Requirements:</strong>
                <br />
                Works with Elementor Free
              </li>
              <li>
                <strong>Commercial License:</strong>
                <br />
                <a
                  href="https://elements.envato.com/user-terms/?utm_source=extensions&utm_medium=referral&utm_campaign=wordpress_item"
                  target="_blank"
                  rel="noopener noreferrer">
                  Free
                </a>
              </li>
            </ul>
          </div>
          {!ignorePluginWarnings && template.missingPlugins.length ? (
            <React.Fragment>
              <h3 className={styles.itemOpenOptionsTitle}>Required Plugins Missing</h3>
              {template.missingPlugins.map((plugin) => {
                if (plugin.slug === "elementor-pro") {
                  return (
                    <div className={styles.itemOpenItemDescription} key={plugin.slug}>
                      <div className={styles.requiredPluginElementorPro} />
                      <p>
                        This template requires Elementor Pro
                        {plugin.min_version ? ` version ${plugin.min_version} or above` : ""}. Before you can import the
                        template you'll need to buy, install and activate
                        <strong> Elementor Pro</strong>.
                      </p>
                      <a href={plugin.url} className={stylesShared.button} target="_blank">
                        {plugin.text}
                      </a>
                      <a
                        href="#"
                        className={styles.importAnyway}
                        onClick={(e) => {
                          e.preventDefault()
                          setIgnorePluginWarnings()
                          return false
                        }}>
                        Ignore warning and import anyway
                      </a>
                    </div>
                  )
                }
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
              {template.templateType.popup ? (
                <div className="envato-elements__collection-template-option--help-text">
                  <div className={styles.itemOpenItemDescription}>Create an Elementor Popup based on this block.</div>
                  <Importer
                    updateSingleItem={updateSingleItem}
                    category="elementor"
                    item={template}
                    importData={{
                      collectionId: template.collectionId,
                      templateId: template.templateId,
                      importType: "elementor-popup-library",
                    }}
                    label="Import Popup"
                    labelImported="Open Popup in Elementor Pro"
                  />
                </div>
              ) : (
                <React.Fragment>
                  {config.get("modalMode") === "elementor" ? (
                    <React.Fragment>
                      <div className={styles.itemOpenItemDescription}>
                        Insert this Elementor Block onto the current page in a single click.
                      </div>
                      <Inserter
                        updateSingleItem={updateSingleItem}
                        category="elementor-blocks"
                        item={template}
                        importData={{
                          collectionId: template.collectionId,
                          templateId: template.templateId,
                          importType: "magic-insert",
                        }}
                        label="Add Block to Page"
                      />
                    </React.Fragment>
                  ) : (
                    <React.Fragment>
                      <div className={styles.itemOpenItemDescription}>
                        Import this template to make it available in your Elementor Saved Templates list for future use.
                      </div>
                      <Importer
                        updateSingleItem={updateSingleItem}
                        category="elementor-blocks"
                        item={template}
                        importData={{
                          collectionId: template.collectionId,
                          templateId: template.templateId,
                          importType: "elementor-library",
                        }}
                        labelImported="Edit Template"
                        label="Import to Library"
                      />
                    </React.Fragment>
                  )}
                </React.Fragment>
              )}
              {needsElementorPro ? (
                <div className={styles.itemOpenItemDescription}>
                  <p>This template includes features from Elementor Pro.</p>
                  <div className={styles.requiredPluginElementorPro} />
                </div>
              ) : null}
            </React.Fragment>
          )}
        </div>
      </div>
    </LazyLoadComponent>
  )
}

const ItemResultWide = trackWindowScroll(LibraryResultsItem)

const LibraryResultsCard = ({
  result,
  template,
  scrollPosition,
  layoutOptions,
  getModalPos,
  updateSingleItem,
  searchChanges,
}) => {
  const imagePlaceHolder = null
  return (
    <LazyLoadComponent scrollPosition={scrollPosition} placeholder={<div className={styles.cardWrapLoading} />}>
      <div
        className={`${styles.cardWrap} ${template.itemImported ? styles.imported : ""} ${
          template.templateInserted && template.templateInserted.length > 0 ? styles.imported : ""
        }`}>
        <div className={styles.inner} style={{ backgroundImage: `url( ${template.largeThumb.src} )` }}>
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
          <Link
            to={`/elementor-blocks?collectionId=${template.collectionId}&templateId=${template.templateId}`}
            onClick={(e) => {
              e.preventDefault()
              searchChanges({ collectionId: template.collectionId, templateId: template.templateId })
              return false
            }}
            className={styles.thumb}>
            &nbsp;
          </Link>
        </div>
        <div className={styles.detailsItemName}>{template.templateName}</div>
      </div>
    </LazyLoadComponent>
  )
}

const ItemResultsCard = trackWindowScroll(LibraryResultsCard)

export default class LibraryResultsElementorBlocks extends Component {
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
    // Only update if the open state changes of a template
    if (this.props.openItem !== nextProps.openItem) {
      // || this.props.searchQuery !== nextProps.searchQuery) {
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
      clearAllBodyScrollLocks()
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

    // searching for blocks.
    if (searchQuery.text && searchQuery.text.length > 0) {
      // if we're searching free text, show all thumbnails.
      if (openItem && openItem.collectionId === result.collectionId && openItem.templateId === result.templateId) {
        return (
          <div className={styles.open} style={getModalPos}>
            <div className={styles.openTitle}>
              <Link
                className={styles.returnToIndex}
                to="/elementor-blocks"
                onClick={(e) => {
                  e.preventDefault()
                  window.history.back()
                  return false
                }}>
                Back to Elementor Blocks
              </Link>
            </div>
            <div className={styles.openContent}>
              <ItemResultWide
                key={`${result.collectionId}${result.templateId}`}
                template={result}
                ignorePluginWarnings={ignorePluginWarnings}
                setIgnorePluginWarnings={this.setIgnorePluginWarnings}
                {...this.props}
              />
            </div>
          </div>
        )
      }
      return <ItemResultsCard key={`${result.collectionId}${result.templateId}`} template={result} {...this.props} />
    }

    if (openItem && openItem.blockGroup) {
      if (openItem.blockGroup === result.slug) {
        // opening a group of items.
        return (
          <div className={styles.open} style={getModalPos}>
            <div className={styles.openTitle}>
              <Link
                className={styles.returnToIndex}
                to="/elementor-blocks"
                onClick={(e) => {
                  e.preventDefault()
                  window.history.back()
                  return false
                }}>
                Back to all Block Kits
              </Link>
            </div>
            <div className={styles.openContent}>
              <div className={styles.openContentWelcome}>
                <h3 className={styles.openContentTitle}>{result.title} Blocks</h3>
                <div className={styles.openContentSubTitle}>
                  {result.blocks.length} Block Templates in this category
                </div>
              </div>
              {result.blocks.map((template) => {
                return (
                  <ItemResultWide
                    key={`${template.collectionId}${template.templateId}`}
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
      return null
    }

    // otherwise by default just group them by block category.
    return typeof result.blocks !== "undefined" && result.blocks.length > 0 ? (
      <div className={styles.blockCategory}>
        <Link
          to={`/elementor-blocks?blockGroup=${result.slug}`}
          className={styles.blockCategoryLink}
          onClick={(e) => {
            e.preventDefault()
            searchChanges({ blockGroup: result.slug })
            return false
          }}>
          <h3 className={styles.blockCategoryTitle}>{result.title}</h3>
          <div className={styles.blockCategoryCount}>{result.blocks.length} blocks</div>
        </Link>
      </div>
    ) : null
  }
}

LibraryResultsElementorBlocks.propTypes = {}
