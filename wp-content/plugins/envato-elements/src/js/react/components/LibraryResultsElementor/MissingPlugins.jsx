import React from "react"
import PropTypes from "prop-types"
import styles from "./LibraryResultsElementor.module.css"
import stylesShared from "../../shared.module.css"
import { getListOfMissingPlugins } from '../../util/requiredPlugins';

/**
 * This renders the missing plugins dialog and shows links that lets the user install/active/upgrade anything that's missing.
 *
 * @param template
 * @param setIgnorePluginWarnings
 * @returns {*}
 * @constructor
 */
const MissingPlugins = ({ template, setIgnorePluginWarnings }) => {
  return (
    <div className={styles.sidebarBox}>
      <h3 className={styles.sidebarBoxTitle}>Required Plugins Missing</h3>
      {template.missingPlugins.map( ( plugin ) => {
        if ( plugin.slug === "elementor-pro" ) {
          return (
            <div className={styles.itemOpenItemDescription} key={plugin.slug}>
              <div className={styles.requiredPluginElementorPro}/>
              <p>
                This template requires Elementor Pro. To ensure this template works best, you'll need to buy and install
                <strong> Elementor Pro</strong> {plugin.min_version ? ` version ${plugin.min_version} or above` : ""}.
              </p>
              <a href={plugin.url} className={stylesShared.button} target="_blank">
                Get Elementor Pro
              </a>
              <a
                href="#"
                className={styles.importAnyway}
                onClick={( e ) => {
                  e.preventDefault()
                  if(setIgnorePluginWarnings) setIgnorePluginWarnings()
                  return false
                }}>
                Ignore note and import anyway
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
      } )}
    </div>
  )
}

MissingPlugins.propTypes = {
  template: PropTypes.shape({
    templateId: PropTypes.string,
    templateName: PropTypes.string,
    itemImported: PropTypes.bool,
    templateInserted: PropTypes.arrayOf(
      PropTypes.shape({
        insertPageUrl: PropTypes.string,
      }),
    ),
    templateFeatures: PropTypes.shape({
      new: PropTypes.shape({
        small: PropTypes.string,
      }),
      premium: PropTypes.shape({
        small: PropTypes.string,
      }),
    }),
    largeThumb: PropTypes.shape({
      src: PropTypes.string,
      width: PropTypes.string,
      height: PropTypes.string,
    }),
  }).isRequired,
  setIgnorePluginWarnings: PropTypes.func.isRequired,
}

export default MissingPlugins
