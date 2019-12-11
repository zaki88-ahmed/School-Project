import React from "react"
import ReactDOM from "react-dom"

import { modal } from "../util/modal"
import { config } from "../util/config"
import { api } from "../util/api"
import LoadingSpinner from "./LoadingSpinner"
import { tokenUrl } from "../util/linkGenerator"

import styles from "./LicenseButton.module.css"
import stylesShared from "../shared.module.css"

export default class LicenseButton extends React.PureComponent {
  constructor(props) {
    super(props)
    this.input = null
    this.modalContent = null
    this.state = {
      tokenVerification: "",
      tokenVerificationMessage: "Success",
      elementsStatus: config.get("elements_status"),
      tokenValue: "",
    }
  }

  tokenEntered = (e) => {
    this.setState({
      tokenValue: e.target.value,
    })
  }

  verifyToken = (e) => {
    const { successCallback } = this.props
    e.preventDefault()
    this.setState({
      tokenVerification: "loading",
    })
    const { tokenValue } = this.state
    config
      .persist("elements_token", tokenValue)
      .then(
        (json) => {
          if (json && json.status === 1) {
            this.setState({ tokenVerification: "success" })
            setTimeout(() => {
              modal.closeModal()
              if (successCallback && typeof successCallback === "function") {
                successCallback()
              }
            }, 800)
          } else {
            switch (json.error_code) {
              case "token_extension_mismatch":
                this.setState({
                  tokenVerification: "failed",
                  tokenVerificationMessage: `Please generate a new token, this one has already been used elsewhere.`,
                })
                break
              case "invalid_token":
                this.setState({
                  tokenVerification: "failed",
                  tokenVerificationMessage: `Sorry that is not a valid Envato Elements token.`,
                })
                break
              case "no_paid_account":
                this.setState({
                  tokenVerification: "failed",
                  tokenVerificationMessage: `Verification Failed - you need a paid, Envato Elements subscription to continue.`,
                })
                break
              default:
                this.setState({
                  tokenVerification: "failed",
                  tokenVerificationMessage: `Something went wrong. ${
                    typeof json.message !== "undefined" ? json.message : ""
                  } (${json.error_code ? json.error_code : JSON.stringify(json)})`,
                })
            }
          }
        },
        (err) => {
          if (err && err.aborted) {
            // Ignore aported xhr requests.
          } else {
            this.setState({
              tokenVerification: "failed",
              tokenVerificationMessage: `Error with verification, please try again. ${
                typeof err.message !== "undefined" ? err.message : ""
              }`,
            })
          }
        },
      )
      .finally(() => {})
  }

  getLicense = (e) => {
    // Double check we haven't got an active token already from a sub photo item.
    const { trackingParams } = this.props
    const elementsStatus = config.get("elements_status")
    if (elementsStatus === "paid") {
      e.preventDefault()
      const { successCallback } = this.props
      this.setState({ tokenVerification: "success" })
      if (successCallback && typeof successCallback === "function") {
        successCallback()
      }
      return false
    }

    modal.closeModal()
    modal.openModal({
      title: "Connect your Envato Elements Subscription",
      message: this.modalContent,
      reactivate: false,
    })

    setTimeout(() => {
      if (this.input) {
        this.input.focus()
      }
    }, 300)

    if (false) {
      const popupWidth = 680
      const popupHeight = 750

      const dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : window.screenX
      const dualScreenTop = window.screenTop != undefined ? window.screenTop : window.screenY

      const width = window.innerWidth
        ? window.innerWidth
        : document.documentElement.clientWidth
        ? document.documentElement.clientWidth
        : screen.width
      const height = window.innerHeight
        ? window.innerHeight
        : document.documentElement.clientHeight
        ? document.documentElement.clientHeight
        : screen.height

      const systemZoom = 1 // width / window.screen.availWidth
      const left = (width - popupWidth) / 2 / systemZoom + dualScreenLeft
      const top = (height - popupHeight) / 2 / systemZoom + dualScreenTop + 100
      const licenseWindow = window.open(
        tokenUrl({ trackingParams }),
        "Envato Elements",
        `scrollbars=yes, width=${popupWidth / systemZoom}, height=${popupHeight /
          systemZoom}, top=${top}, left=${left}`,
      )
      if (!licenseWindow || licenseWindow.closed || typeof licenseWindow.closed === "undefined") {
        // popup didn't work, continue with normal _blank link
      } else {
        if (licenseWindow.focus) licenseWindow.focus()
        // popup worked! kill the default _blank action
        e.preventDefault()
        return false
      }
    }

    return true
  }

  render() {
    const { label, trackingParams } = this.props
    const { tokenVerification, tokenVerificationMessage, tokenValue } = this.state
    const licenseStates = {
      success: (
        <div className={styles.tokenSuccess}>
          <h2 className={styles.tokenSuccessTitle}>Success</h2>
          <p>Your subscription has been verified</p>
        </div>
      ),
      loading: (
        <div className={styles.tokenLoading}>
          <LoadingSpinner />
        </div>
      ),
      default: (
        <div className={styles.tokenInput}>
          <h2 className={styles.title}>Verify your Envato Elements Subscription</h2>
          <p>Enter your token below to verify your Subscription</p>
          {tokenVerification === "failed" ? <div className={styles.tokenError}>{tokenVerificationMessage}</div> : ""}
          <form onSubmit={this.verifyToken} className={styles.tokenWrap}>
            <input
              data-cy="elements-token-input"
              ref={(input) => {
                this.input = input
              }}
              onChange={this.tokenEntered}
              value={tokenValue}
              className={stylesShared.textInput}
              style={{ width: "70%" }}
              spellCheck="false"
              autoComplete="false"
            />
            <button
              data-cy="elements-token-submit"
              onClick={this.verifyToken}
              className={`${stylesShared.button} ${tokenValue.length !== 36 ? stylesShared.buttonSecondary : ""}`}
              style={{ width: "30%", marginLeft: "20px" }}>
              Verify Token
            </button>
          </form>
          <p className={styles.generateTokenLink}>
            <a href={tokenUrl({ trackingParams })} target="_blank" rel="noopener noreferrer">
              Follow this link
            </a>{" "}
            to generate a new Envato Elements Token.
          </p>
        </div>
      ),
    }
    return (
      <div className={styles.wrap}>
        <a
          href={tokenUrl({ trackingParams })}
          data-cy="get-elements-token"
          target="_blank"
          rel="noopener noreferrer"
          onClick={this.getLicense}
          className={stylesShared.button}>
          {label || "Get Started"}
        </a>
        <div
          className={styles.modalContentInject}
          ref={(modalContent) => {
            this.modalContent = modalContent
          }}>
          {typeof licenseStates[tokenVerification] !== "undefined"
            ? licenseStates[tokenVerification]
            : licenseStates.default}
        </div>
      </div>
      // .. Open butotn straigth away then modal in background.
    )
  }
}

LicenseButton.propTypes = {}
