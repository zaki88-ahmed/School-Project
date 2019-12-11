import React from "react"
import { config } from "../../util/config"
import styles from "./LibraryResultsElementor.module.css"
import LicenseButton from "../LicenseButton"
import stylesShared from "../../shared.module.css"

const PremiumNotice = ({ needsElementorPro, template }) => {
  const elementorProMissing = needsElementorPro
    ? template.missingPlugins.find((plugin) => plugin.slug === "elementor-pro").length > 0
    : false

  return (
    <div className={styles.sidebarBox}>
      <h3 className={styles.sidebarBoxTitle}>Want to up your game with this Premium Template?</h3>
      {elementorProMissing ? (
        <p>
          This template requires both an <strong>Envato Elements</strong> subscription &amp; the{" "}
          <strong>Elementor Pro</strong> plugin.
        </p>
      ) : (
        <p>
          This template is curently exclusive to paid, Envato Elements Subscribers. If you’re already a subscriber or
          you’d like to sign up, click the button below.
        </p>
      )}
      <div className={styles.envatoElementsLogo} />
      <LicenseButton
        label="Get Started"
        successCallback={() => window.location.reload()}
        trackingParams={{ utm_content: "template-item" }}
      />
      {elementorProMissing ? (
        <div className={styles.itemOpenItemDescription} style={{ marginTop: "20px" }}>
          <div className={styles.requiredPluginElementorPro} />
          <a href={elementorProMissing[0].url} className={stylesShared.button} target="_blank">
            {elementorProMissing[0].text}
          </a>
        </div>
      ) : null}
    </div>
  )
}

export default PremiumNotice
