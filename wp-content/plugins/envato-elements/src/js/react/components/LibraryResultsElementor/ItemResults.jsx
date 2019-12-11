import { LazyLoadComponent, trackWindowScroll } from "react-lazy-load-image-component"
import { Link } from "react-router-dom"
import React from "react"
import PropTypes from "prop-types"
import styles from "./LibraryResultsElementor.module.css"
import ImportTemplate from "./ImportTemplate"
import PreviewImage from "./PreviewImage"
import ItemFeatures from "./ItemFeatures"
import MissingPlugins from "./MissingPlugins"
import FeatureOverlay from "./FeatureOverlay"
import PremiumNotice from "./PremiumNotice"
import { config } from "../../util/config"

const ItemResults = ({
  summary,
  fromSearch,
  result,
  template,
  scrollPosition,
  openItem,
  getModalPos,
  updateSingleItem,
  searchChanges,
  ignorePluginWarnings,
  setIgnorePluginWarnings,
}) => {
  if(!template)return null
  const needsElementorPro = !!template.templateFeatures["elementor-pro"]
  const isPremiumTemplate = !!result.features.premium
  const showPremiumRequiredNotice = isPremiumTemplate && config.get("elements_status") !== "paid"
  let allowTemplateImport = !isPremiumTemplate || (isPremiumTemplate && config.get("elements_status") === "paid")

  if (!ignorePluginWarnings && template.missingPlugins.length) {
    allowTemplateImport = false
  }
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
                {fromSearch ? "Back to Elementor Templates" : `Back to Template Kit`}
              </Link>
            </div>
            <div className={styles.itemOpenContent}>
              <div className={styles.itemOpenContentWelcome}>
                <h3 className={styles.itemOpenContentTitle}>
                  {result.collectionName} - {template.templateName}
                </h3>
              </div>
              <div className={styles.itemOpenItem}>
                <PreviewImage result={result} template={template} />
              </div>
              <div className={styles.itemOpenOptions}>
                <ItemFeatures needsElementorPro={needsElementorPro} />
                {showPremiumRequiredNotice ? (
                  <PremiumNotice needsElementorPro={needsElementorPro} template={template} />
                ) : null}
                {!ignorePluginWarnings && template.missingPlugins.length && !showPremiumRequiredNotice ? (
                  <MissingPlugins template={template} setIgnorePluginWarnings={setIgnorePluginWarnings} />
                ) : null}
                {allowTemplateImport ? (
                  <ImportTemplate
                    result={result}
                    updateSingleItem={updateSingleItem}
                    needsElementorPro={needsElementorPro}
                    template={template}
                  />
                ) : null}
              </div>
            </div>
          </div>
        ) : (
          ""
        )}
        <div className={styles.inner}>
          <div className={styles.background} style={{ backgroundImage: `url( ${template.previewThumb} )` }} />
          <div className={styles.features}>
            <FeatureOverlay result={result} template={summary ? {} : template} />
          </div>
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

ItemResults.propTypes = {
  summary: PropTypes.bool,
  fromSearch: PropTypes.bool,
  scrollPosition: PropTypes.shape({
    x: PropTypes.number,
    y: PropTypes.number,
  }),
  openItem: PropTypes.shape({}),
  getModalPos: PropTypes.shape({
    pos: PropTypes.string,
  }).isRequired,
  updateSingleItem: PropTypes.func.isRequired,
  searchChanges: PropTypes.func.isRequired,
  ignorePluginWarnings: PropTypes.bool,
  setIgnorePluginWarnings: PropTypes.func,
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
  template: PropTypes.shape({
    templateId: PropTypes.string,
    templateName: PropTypes.string,
    itemImported: PropTypes.bool,
    templateInserted: PropTypes.arrayOf(
      PropTypes.shape({
        insertPageUrl: PropTypes.string,
      }),
    ),
    largeThumb: PropTypes.shape({
      src: PropTypes.string,
      width: PropTypes.string,
      height: PropTypes.string,
    }),
  }).isRequired,
}

ItemResults.defaultProps = {
  summary: false,
  fromSearch: false,
  openItem: null,
  ignorePluginWarnings: false,
  setIgnorePluginWarnings: null,
  scrollPosition: {},
}

export default trackWindowScroll(ItemResults)
