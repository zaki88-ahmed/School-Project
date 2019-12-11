import React, { Component } from "react"
import PropTypes from "prop-types"
import ProjectName from "./ProjectName"
import LicenseButton from "./LicenseButton"
import { config } from "../util/config"
import styles from "./Settings.module.css"
import stylesShared from "../shared.module.css"

export default class App extends Component {
  constructor(props) {
    super(props)

    this.state = {}
  }

  licenseChanged = () => {
    this.forceUpdate()
  }

  render() {
    const elementsStatus = config.get("elements_status")
    return (
      <div className={styles.wrap}>
        <div className={styles.welcome}>
          <h1>Settings</h1>
        </div>
        <div className={styles.cards}>
          {elementsStatus !== "paid" ? (
            <div className={styles.license}>
              <h2>License:</h2>
              <div>
                <p>To download and use certain items you need to become an Envato Elements subscriber.</p>
                <LicenseButton
                  successCallback={this.licenseChanged}
                  label="Enter license code"
                  trackingParams={{ utm_content: "settings" }}
                />
              </div>
            </div>
          ) : (
            <div className={styles.projectName}>
              <h2>Success:</h2>
              <p>You are now connected.</p>
              <p>
                When content is imported into WordPress it is licensed against an Envato Elements project. Please choose
                the default project name here: <br />
                <br />
                <ProjectName />
              </p>
            </div>
          )}
          <div className={styles.reset}>
            <h2>Reset Plugin:</h2>
            <p>
              Sometimes we all need a good reset!
              <br />
              Clicking this button will clear the Envato Elements cache and remove any settings. <br />A new Envato
              Elements token will be needed after reset. This will not remove any imported templates or photos.
            </p>
            <a href={config.get("license_deactivate")} className={`${stylesShared.button} ${stylesShared.resetButton}`}>
              Clear Cache & Reset Plugin
            </a>
          </div>
        </div>
      </div>
    )
  }
}

App.propTypes = {}
