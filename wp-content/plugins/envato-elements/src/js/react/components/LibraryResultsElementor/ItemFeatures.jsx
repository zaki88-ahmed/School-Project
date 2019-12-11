import PropTypes from "prop-types"
import React from "react"
import styles from "./LibraryResultsElementor.module.css"
import stylesShared from "../../shared.module.css"

/**
 * This shows a link to our terms & conditions in the sidebar of the "Insert Elementor Template" page.
 *
 * @param needsElementorPro bool if this template needs Elementor Pro or not.
 * @returns {*}
 * @constructor
 */
const ItemFeatures = ({ needsElementorPro }) => (
  <div className={styles.openFeatures}>
    <ul className={stylesShared.bullets}>
      <li>
        <strong>Plugin Requirements:</strong>
        <br />
        {needsElementorPro ? "Template designed for Elementor Pro." : "Works fine with Elementor Free."}
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
)

ItemFeatures.propTypes = {
  needsElementorPro: PropTypes.bool.isRequired,
}

export default ItemFeatures
