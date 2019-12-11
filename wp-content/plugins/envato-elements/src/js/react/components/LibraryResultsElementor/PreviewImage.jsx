import React from "react"
import PropTypes from "prop-types"
import styles from "./LibraryResultsElementor.module.css"
import FeatureOverlay from './FeatureOverlay';

/**
 * Ref used to figure out when the preview image loads so we can do some css fade in animation.
 *
 * @type ref
 */
let imagePlaceHolder = null

/**
 * This prints out the preview image and sets a ref so we can do css fade in animation on large thumbnail load.
 *
 * @param template
 * @returns {*}
 * @constructor
 */
const PreviewImage = ({ result, template }) => (
  <div
    className={styles.imagePlaceHolder}
    style={{
      backgroundImage: `url( ${template.previewThumb} )`,
      height: `${template.largeThumb.height}px`,
      maxWidth: `${template.largeThumb.width}px`,
    }}
    ref={(ref) => (imagePlaceHolder = ref)}>
    <div className={styles.features}>
      <FeatureOverlay result={result} template={template} />
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
)

PreviewImage.propTypes = {
  result: PropTypes.shape({
    features: PropTypes.shape({
      premium: PropTypes.bool,
      new: PropTypes.bool,
    }),
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

export default PreviewImage
