import React from "react"
import PropTypes from "prop-types"
import styles from "./LibraryResultsElementor.module.css"

const FeatureOverlay = ({ result, template }) => (
  <React.Fragment>
    {template.itemImported || (template.templateInserted && template.templateInserted.length > 0) ? (
      <span className={styles.featureImported}>Imported</span>
    ) : null}
    {result.features
      ? Object.entries(result.features).map((feature) =>
          feature[0] === "premium" ? (
            <span key={feature[0]} className={`${styles.featureOther} ${styles[`featureOther${feature[0]}`]}`}>
              <span className={styles.featureTooltip}>Premium Template</span>
            </span>
          ) : null,
        )
      : null}
    {/* template.templateFeatures
      ? Object.entries(template.templateFeatures).map((feature) => (
          <span key={feature[0]} className={styles.featureOther}>
            {feature[1].small}
          </span>
        ))
      : null */}
  </React.Fragment>
)

FeatureOverlay.propTypes = {
  result: PropTypes.shape({
    features: PropTypes.shape({
      premium: PropTypes.string,
      new: PropTypes.string,
    }),
  }).isRequired,
  template: PropTypes.shape({
    itemImported: PropTypes.bool,
    templateInserted: PropTypes.arrayOf(
      PropTypes.shape({
        insertPageUrl: PropTypes.string,
      }),
    ),
  }).isRequired,
}

export default FeatureOverlay
