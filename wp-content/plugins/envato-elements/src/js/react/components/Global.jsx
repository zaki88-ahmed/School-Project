import React, { Component } from "react"
import PropTypes from "prop-types"
import { HashRouter, withRouter, Route } from "react-router-dom"
import styles from "./Global.module.css"

import { config } from "../util/config"

import Home from "./Home"
import Header from "./Header"
import Elementor from "./Elementor"
import ElementorBlocks from "./ElementorBlocks"
import BeaverBuilder from "./BeaverBuilder"
import Photos from "./Photos"
import Settings from "./Settings"

class Global extends React.PureComponent {
  constructor(props) {
    super(props)
    this.state = {
      currentModalPos: {},
    }
    this.wrapperRef = null
  }

  getModalPos = () => {
    const position = {
      left: window.innerWidth <= 782 ? 0 : jQuery("#adminmenuwrap").width(),
      headerTop: jQuery("#wpadminbar").height(),
      top: jQuery("#wpadminbar").height() + 56,
      right: 0,
      bottom: 0,
    }
    if (config.get("modalMode") === "elementor") {
      // only in modal mode.
      const modalWrapper = jQuery(this.wrapperRef)
        .parents(".dialog-lightbox-widget-content")
        .first()
      if (modalWrapper.get(0)) {
        const modalWrapperPos = modalWrapper.get(0).getBoundingClientRect()
        position.left = modalWrapperPos.left
        position.headerTop = modalWrapperPos.top
        position.top = modalWrapperPos.top + 56
        position.right = window.innerWidth - modalWrapperPos.right
        position.bottom = window.innerHeight - modalWrapperPos.bottom
      }
    } else if (config.get("modalMode") === "wpMedia") {
      // change pos in deep photo integration mode.
      const mediaWrapper = jQuery(this.wrapperRef)
        .parents(".envatoelements-attachments-browser")
        .first()
      if (mediaWrapper.get(0)) {
        const modalWrapperPos = mediaWrapper.get(0).getBoundingClientRect()
        position.left = modalWrapperPos.left
        position.headerTop = modalWrapperPos.top
        position.top = modalWrapperPos.top
        position.right = window.innerWidth - modalWrapperPos.right
        position.bottom = window.innerHeight - modalWrapperPos.bottom
      }
    }

    return position
  }

  componentDidMount() {
    this.updateWordPressSidebarNavigation()
    this.updateFixedPositions()
    window.addEventListener("resize", () => {
      this.updateFixedPositions()
    })
    setTimeout(() => {
      // Needed for deep integration popups to function correctly.
      this.updateFixedPositions()
    }, 300)
    jQuery("body").on("click", "#collapse-button", () => {
      this.updateFixedPositions()
    })
  }

  componentDidUpdate(prevProps) {
    const { location } = this.props
    if (location.pathname !== prevProps.location.pathname) {
      // Change the currently highlighted navigation menu.
      this.updateWordPressSidebarNavigation()
    }
  }

  updateWordPressSidebarNavigation = () => {
    const { location } = this.props
    const $sideNav = jQuery("li#toplevel_page_envato-elements")
    if ($sideNav.length) {
      $sideNav.find(".current").removeClass("current")
      const hash =
        location.pathname && location.pathname !== "#" && location.pathname !== "/" ? location.pathname : "/home"
      let $currentNav = $sideNav.find(`[href*="${hash}"]`)
      if (!$currentNav.length) {
        $currentNav = $sideNav.find("ul a").first()
      }
      $currentNav.addClass("current")
      $currentNav
        .parent("li")
        .first()
        .addClass("current")
    }
  }

  updateFixedPositions = () => {
    this.setState({
      currentModalPos: this.getModalPos(),
    })
  }

  render() {
    const navigation = config.get("navigation")
    const categories = config.get("categories")
    const { location, history, photoUploadCompleteCallback } = this.props
    const { currentModalPos } = this.state

    const normalNavigation = config.get("hideNavigation") === true || window.innerWidth <= 782

    return (
      <div className={normalNavigation ? styles.wrapperNormal : styles.wrapperFixed}>
        {config.get("hideNavigation") === true ? null : (
          <Header
            navigation={navigation}
            getModalPos={currentModalPos}
            location={location}
            normalNavigation={normalNavigation}
          />
        )}
        <div className={styles.scroller} ref={(ref) => (this.wrapperRef = ref)}>
          <Route
            path="/"
            exact
            render={(props) => {
              setTimeout(() => {
                if (location && (location.pathname === "" || location.pathname === "/")) {
                  history.push(`/${navigation[0].slug}`)
                }
              }, 200)
              return null
            }}
          />
          <Route
            path="/elementor"
            render={(props) => <Elementor {...props} categories={categories} getModalPos={currentModalPos} />}
          />
          <Route
            path="/elementor-blocks"
            render={(props) => <ElementorBlocks {...props} categories={categories} getModalPos={currentModalPos} />}
          />
          <Route
            path="/beaver-builder"
            render={(props) => <BeaverBuilder {...props} categories={categories} getModalPos={currentModalPos} />}
          />
          <Route
            path="/photos"
            render={(props) => (
              <Photos
                {...props}
                photoUploadCompleteCallback={photoUploadCompleteCallback}
                categories={categories}
                getModalPos={currentModalPos}
              />
            )}
          />
          <Route path="/settings" component={Settings} />
        </div>
        <div className={styles.footer}>
          <p>
            <strong>Feedback &amp; Support: </strong> If you have any questions or feedback for the team please send an
            email to <a href="mailto:extensions@envato.com">extensions@envato.com</a> |{" "}
            <a
              href="https://elements.envato.com/user-terms/?utm_source=extensions&utm_medium=referral&utm_campaign=wordpress_footer"
              target="_blank"
              rel="noreferrer noopener">
              Terms &amp; Conditions
            </a>{" "}
            |{" "}
            <a
              href="https://envato.com/privacy?utm_source=extensions&utm_medium=referral&utm_campaign=wordpress_footer"
              target="_blank"
              rel="noreferrer noopener">
              Privacy Policy
            </a>
          </p>
        </div>
      </div>
    )
  }
}

Global.propTypes = {}

export default withRouter((props) => <Global {...props} />)
