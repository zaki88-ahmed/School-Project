import React, { Component } from "react"
import PropTypes from "prop-types"
import { Link } from "react-router-dom"

import { LazyLoadComponent, trackWindowScroll } from "react-lazy-load-image-component"
import { clearAllBodyScrollLocks, disableBodyScroll } from "body-scroll-lock"
import styles from "./LibraryResultsPhotos.module.css"
import stylesShared from "../shared.module.css"
import Importer from "./Importer"
import Inserter from "./Inserter"
import LicenseButton from "./LicenseButton"
import ProjectName from "./ProjectName"
import { scroll } from "../util/scroll"
import { config } from "../util/config"

class LibraryResultsPhotos extends Component {
  constructor(props) {
    super(props)
    this.photoRef = null
    this.state = {
      isOpen: false,
    }
  }

  shouldComponentUpdate(nextProps, nextState) {
    // always update if the screensize changes
    if (this.props.getModalPos !== nextProps.getModalPos) {
      return true
    }
    // always update if the display state changes.
    if (this.props.layoutOptions.display !== nextProps.layoutOptions.display) {
      return true
    }
    // Update if import finishes
    if (nextProps.result.itemImported && this.props.result.itemImported !== nextProps.result.itemImported) {
      return true
    }
    // Only update if the open state changes of a photo
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
      disableBodyScroll(this.photoRef)
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

  licenseChanged = () => {
    this.forceUpdate()
  }

  render() {
    const {
      result,
      scrollPosition,
      openItem,
      getModalPos,
      searchChanges,
      layoutOptions,
      updateSingleItem,
      photoUploadCompleteCallback,
    } = this.props
    const elementsStatus = config.get("elements_status")
    let style = {},
      innerStyle = {
        backgroundImage: `url( ${result.imageThumb.src} )`,
      }
    if (layoutOptions.display === "square") {
      // style.width = result.imageThumb.gridHeight
      // style.height = result.imageThumb.gridHeight
    } else {
      style.width = `${result.calculatedMasonryWidth}%`
      innerStyle.paddingBottom = `${result.aspectRatioHeight}%`
    }
    return (
      <div
        className={`${layoutOptions.display === "square" ? styles.wrapSquare : styles.wrapFluid} ${
          result.photoImported ? styles.imported : ""
        }`}
        ref={(photo) => (this.photoRef = photo)}
        style={style}>
        {openItem ? (
          <div className={styles.open} style={getModalPos}>
            <div className={styles.openTitle}>
              <Link
                className={styles.returnToIndex}
                to="/photos"
                onClick={(e) => {
                  e.preventDefault()
                  window.history.back()
                  return false
                }}>
                Back to Photos
              </Link>
            </div>
            <div className={styles.openContent}>
              <div className={styles.openPhoto}>
                <div
                  className={styles.imagePlaceHolder}
                  style={{
                    backgroundImage: `url( ${result.imageThumb.src} )`,
                    maxWidth: result.imageLarge.width,
                    height: result.imageLarge.height,
                  }}
                  ref={(imagePlaceHolder) => (this.imagePlaceHolder = imagePlaceHolder)}>
                  <div className={styles.features}>
                    {result.itemImported ? <span className={styles.featureImported}>Imported</span> : ""}
                  </div>
                  <img
                    src={result.imageLarge.src}
                    width={result.imageLarge.width}
                    height={result.imageLarge.height}
                    alt={result.title}
                    className={styles.openPhotoSrc}
                    onLoad={() => {
                      this.imagePlaceHolder.className = `${this.imagePlaceHolder.className} ${
                        styles.imagePlaceHolderLoaded
                      }`
                    }}
                  />
                </div>
              </div>
              <div className={styles.openOptions}>
                <h3 className={styles.openPhotoName}>{result.title}</h3>
                <div className={styles.openAuthor}>
                  <a
                    href={`https://elements.envato.com/${result.slug}-${
                      result.photoId
                    }?utm_source=extensions&utm_medium=referral&utm_campaign=wordpress_photos_page`}
                    className={styles.outboundElementsLink}
                    target="_blank"
                    rel="noreferrer noopener">
                    By {result.contributor_username}
                  </a>
                </div>
                <div className={styles.openFeatures}>
                  <ul className={stylesShared.bullets}>
                    <li>
                      <strong>Orientation</strong>
                      <br />
                      {result.item_attributes.orientation}
                    </li>
                    {result.displayWidth ? (
                      <li>
                        <strong>Dimensions</strong>
                        <br />
                        {result.displayWidth}px x {result.displayHeight}px
                      </li>
                    ) : (
                      ""
                    )}
                    <li>
                      <strong>Commercial License:</strong>
                      <br />
                      <a
                        href="https://elements.envato.com/license-terms?utm_source=extensions&utm_medium=referral&utm_campaign=wordpress_photos_license"
                        target="_blank"
                        rel="noopener noreferrer">
                        Further Information
                      </a>
                    </li>
                  </ul>
                </div>
                <div className={styles.openDivider} />

                {elementsStatus !== "paid" ? (
                  <div className={styles.needsLicense}>
                    <p>To download and use this photo, you need to become an Envato Elements subscriber.</p>
                    <LicenseButton
                      successCallback={this.licenseChanged}
                      trackingParams={{ utm_content: "photo-item" }}
                    />
                  </div>
                ) : (
                  <div className={styles.readyToLicense}>
                    <p>
                      I understand that this image will be licensed to the project named <ProjectName /> and is subject
                      to the standard <br />
                      <a
                        href="https://elements.envato.com/license-terms?utm_source=extensions&utm_medium=referral&utm_campaign=wordpress_photos_license"
                        rel="noreferrer noopener"
                        target="_blank">
                        Envato Elements License
                      </a>
                      .
                    </p>
                    {config.get("modalMode") ? (
                      <Inserter
                        photoUploadCompleteCallback={photoUploadCompleteCallback}
                        updateSingleItem={updateSingleItem}
                        item={result}
                        modalMode={config.get("modalMode")}
                        category="photos"
                        importData={{
                          itemId: result.uuid,
                          photoName: result.title,
                          photoDescription: result.description,
                          importType: "magic-insert",
                        }}
                        label="License & Insert Photo on Page"
                        labelImported="Insert Photo on Page"
                      />
                    ) : (
                      <Importer
                        updateSingleItem={updateSingleItem}
                        item={result}
                        category="photos"
                        importData={{
                          itemId: result.uuid,
                          photoName: result.title,
                          photoDescription: result.description,
                          importType: "media-library",
                        }}
                        label="License & Download into Media Library"
                        labelImported="View Image in Media Library"
                      />
                    )}
                  </div>
                )}
              </div>
            </div>
          </div>
        ) : (
          ""
        )}
        <LazyLoadComponent scrollPosition={scrollPosition}>
          <div className={styles.inner} style={innerStyle}>
            <div className={styles.features}>
              {result.itemImported ? <span className={styles.featureImported}>Imported</span> : ""}
            </div>
            <Link
              to={`/photos?photoId=${result.humane_id}`}
              onClick={(e) => {
                e.preventDefault()
                searchChanges({ photoId: result.humane_id })
                return false
              }}
              className={styles.link}>
              &nbsp;
            </Link>
            <div className={styles.details}>
              <div className={styles.detailsItemName}>{result.title}</div>
            </div>
          </div>
        </LazyLoadComponent>
      </div>
    )
  }
}

export default trackWindowScroll(LibraryResultsPhotos)

LibraryResultsPhotos.propTypes = {}
