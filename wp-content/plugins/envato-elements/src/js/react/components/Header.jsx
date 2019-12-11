import React, { Component } from "react"
import PropTypes from "prop-types"
import { Link, NavLink } from "react-router-dom"
import { config } from "../util/config"
import styles from "./Header.module.css"
import stylesShared from "../shared.module.css"
import { api } from "../util/api"

export default class Header extends Component {
  constructor(props) {
    super(props)
    this.state = {
      unseenNotifications: config.get("unseen_notifications"),
    }
  }

  notificationViewed = () => {
    const { unseenNotifications } = this.state
    if (unseenNotifications.length > 0) {
      api
        .post(
          "notifications/read",
          {
            ids: unseenNotifications,
          },
          {},
        )
        .then(
          (json) => {
            this.setState({ unseenNotifications: [] })
          },
          (err) => {},
        )
    }
  }

  render() {
    const { navigation, getModalPos, location, normalNavigation } = this.props
    const { headerTop, left, right } = getModalPos
    const { unseenNotifications } = this.state
    const currentNotifications = config.get("current_notifications")
    return (
      <div
        className={normalNavigation ? styles.wrapperNormal : styles.wrapperFixed}
        style={{ top: headerTop, left, right }}>
        <div className={styles.logo}>
          <Link to="/" className={styles.logoLink}>
            Envato Elements
          </Link>
        </div>

        <nav className={styles.menu}>
          <ul className={styles.menuInner}>
            {navigation.map((category) => {
              return (
                <li
                  className={`${styles.menuItem} ${category.sub_nav.length ? styles.menuItemHasChild : ""}`}
                  key={category.slug}>
                  <Link
                    to={`/${category.slug}`}
                    className={`${styles.menuLink} ${
                      category.sub_nav.length > 0
                        ? location.pathname.match(category.slug)
                          ? styles.menuLinkActive
                          : ""
                        : location.pathname === `/${category.slug}`
                        ? styles.menuLinkActive
                        : ""
                    } ${category.new_flag ? styles.menuLinkNew : ""}`}>
                    {category.nav_title}
                  </Link>
                  {category.sub_nav.length ? (
                    <ul className={styles.subNavWrap}>
                      {category.sub_nav.map((subtype) => {
                        return (
                          <li className={styles.subNavItem} key={subtype.slug}>
                            <Link
                              to={`/${subtype.slug}`}
                              className={`${styles.menuLink} ${
                                location.pathname === `/${subtype.slug}` ? styles.menuLinkActive : ""
                              }`}>
                              {subtype.name}
                            </Link>
                          </li>
                        )
                      })}
                    </ul>
                  ) : (
                    ""
                  )}
                </li>
              )
            })}
          </ul>
          {config.get("modalMode") === "elementor" ? (
            <ul className={`${styles.menuInner} ${styles.menuRight}`}>
              <li className={styles.menuItem}>
                <a
                  href="#"
                  onClick={(e) => {
                    e.preventDefault()
                    window.elementsModal.hide()
                    return false
                  }}
                  className={styles.menuLink}>
                  <span className="dashicons dashicons-no" />
                </a>
              </li>
            </ul>
          ) : null}
          {!config.get("minimalMenu") ? (
            <ul className={`${styles.menuInner} ${styles.menuRight}`}>
              {currentNotifications.length > 0 ? (
                <li
                  className={`${styles.menuItem} ${styles.menuItemHasChild}`}
                  onMouseOver={this.notificationViewed}
                  onFocus={this.notificationViewed}>
                  <span className={styles.menuLink}>Updates</span>
                  {unseenNotifications.length > 0 ? (
                    <span className={styles.menuCountLabel}>{unseenNotifications.length}</span>
                  ) : null}
                  <div className={`${styles.subNavWrap} ${styles.subNavWrapNotifications}`}>
                    <div className={styles.dropDownInner}>
                      <ul className={stylesShared.bullets}>
                        {currentNotifications.map((notification) => {
                          return (
                            <li className={styles.notification} key={notification.id}>
                              <div className={styles.date}>{notification.date}</div>
                              <div className={styles.title}>{notification.title}</div>
                              <div
                                className={styles.content}
                                dangerouslySetInnerHTML={{
                                  __html: notification.content,
                                }}
                              />
                            </li>
                          )
                        })}
                      </ul>
                    </div>
                  </div>
                </li>
              ) : null}
              {/* <li className={`${styles.menuItem} ${styles.menuItemHasChild}`}> */}
              {/* <span className={styles.menuLink}>Activity</span> */}
              {/* </li> */}
              <li className={styles.menuItem}>
                <Link
                  to="/settings"
                  className={`${styles.menuLink} ${location.pathname.match("settings") ? styles.menuLinkActive : ""}`}>
                  <span className="dashicons dashicons-admin-generic" />
                </Link>
              </li>
            </ul>
          ) : (
            ""
          )}
        </nav>
      </div>
    )
  }
}

Header.propTypes = {
  navigation: PropTypes.array,
}
