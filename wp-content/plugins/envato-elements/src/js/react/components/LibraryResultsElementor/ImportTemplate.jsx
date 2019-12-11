import React from "react"
import PropTypes from "prop-types"
import { config } from "../../util/config"
import styles from "./LibraryResultsElementor.module.css"
import LicenseButton from "../LicenseButton"
import Importer from "../Importer"

/**
 * This lets the user import a template. It shows a button to import template into library
 * or create a draft page straight from the template.
 *
 * @param result
 * @param needsElementorPro
 * @param updateSingleItem
 * @param template
 * @returns {*}
 * @constructor
 */
const ImportTemplate = ({ result, needsElementorPro, updateSingleItem, template }) => (
  <React.Fragment>
    <div className={styles.itemOpenOptionsBlock}>
      <h3 className={styles.itemOpenOptionsTitle}>Import Template</h3>
      <div className={styles.itemOpenItemDescription}>
        Import this template to make it available in your Elementor Saved Templates list for future use.
      </div>
      <Importer
        updateSingleItem={updateSingleItem}
        category="elementor"
        item={template}
        importData={{
          collectionId: result.collectionId,
          templateId: template.templateId,
          importType: "elementor-library",
        }}
        label="Import Template"
        labelImported="Open Template in Library"
      />
    </div>
    <div className={styles.itemOpenOptionsBlock}>
      <h3 className={styles.itemOpenOptionsTitle}>Create Page from Template</h3>
      <div className={styles.itemOpenItemDescription}>
        Create a new page from this template to make it available as a draft page in your Pages list.
      </div>
      <Importer
        updateSingleItem={updateSingleItem}
        category="elementor"
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
    {needsElementorPro ? (
      <div className={styles.itemOpenOptionsBlock}>
        <h3 className={styles.itemOpenOptionsTitle}>Elementor Pro</h3>
        <p>This template includes features from</p>
        <div className={styles.requiredPluginElementorPro} />
      </div>
    ) : null}
  </React.Fragment>
)

ImportTemplate.propTypes = {
  result: PropTypes.shape({
    categorySlug: PropTypes.string,
    collectionName: PropTypes.string,
    features: PropTypes.shape({
      premium: PropTypes.bool,
      new: PropTypes.bool,
    }),
    collectionId: PropTypes.string,
    templates: PropTypes.arrayOf(
      PropTypes.shape({
        templateId: PropTypes.string,
      }),
    ),
  }).isRequired,
  needsElementorPro: PropTypes.bool.isRequired,
  updateSingleItem: PropTypes.func.isRequired,
  template: PropTypes.shape({
    templateId: PropTypes.string,
    templateName: PropTypes.string,
    itemImported: PropTypes.bool,
    templateInserted: PropTypes.arrayOf(
      PropTypes.shape({
        insertPageUrl: PropTypes.string,
      }),
    ),
    templateFeatures: PropTypes.arrayOf(
      PropTypes.shape({
        new: PropTypes.shape({
          small: PropTypes.string,
        }),
        premium: PropTypes.shape({
          small: PropTypes.string,
        }),
      }),
    ),
    largeThumb: PropTypes.shape({
      src: PropTypes.string,
      width: PropTypes.string,
      height: PropTypes.string,
    }),
  }).isRequired,
}

export default ImportTemplate
