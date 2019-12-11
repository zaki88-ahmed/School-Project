import React from "react"

import LicenseButton from "./LicenseButton"
import { config } from "../util/config"

import styles from "./LibrarySearch.module.css"
import stylesShared from "../shared.module.css"

/**
 * Filter drop down component (Orientation, Background, Colors).
 *
 * @param label
 * @param name
 * @param attributes
 * @param searchFilterChange
 * @param values
 * @returns {*}
 * @constructor
 */
const Filter = ({ label, name, attributes, searchFilterChange, values, columns }) => {
  // If a filter is selected we use the value as the main label on display.
  let filterLabel = label
  Object.entries(attributes).filter((attribute) => {
    if (attribute[1].label && values[name] === attribute[0]) {
      filterLabel = attribute[1].label
    }
    return false
  })
  return (
    <div className={styles.filter}>
      <div className={styles.filterLabel}>
        {filterLabel}
        <div className={`${styles.filterAttributes} ${columns === 2 ? styles.filterAttributesWide : ""}`}>
          {Object.entries(attributes).map((attribute) =>
            attribute[1].label && attribute[1].label.length > 0 ? (
              <div key={attribute[0]} className={styles.filterAttribute}>
                <label htmlFor={`filter${name}${attribute[0]}`}>
                  <input
                    type="checkbox"
                    className={`${styles.filterAttributeCheckbox} ${
                      attribute[1].color ? styles.filterAttributeCheckboxColor : ""
                    } ${attribute[1].color ? styles[`filterAttributeCheckboxColor--${attribute[1].color}`] : ""}`}
                    name={attribute[0]}
                    value={1}
                    checked={values[name] === attribute[0]}
                    id={`filter${name}${attribute[0]}`}
                    onChange={(e) => {
                      searchFilterChange(name, attribute[0], e.target.checked, ["tag"])
                    }}
                  />
                  {attribute[1].label}
                </label>
              </div>
            ) : null,
          )}
        </div>
      </div>
    </div>
  )
}

/**
 * Component for the main search bar at top of page.
 */
export default class LibrarySearchPhotos extends React.PureComponent {
  constructor(props) {
    super(props)

    // This is the free text search input box.
    this.txtRef = null

    // We display a welcome message in place of the search tags if the user isn't paid or hasn't yet performed a search:
    this.state = {
      showWelcomeMessage: !props.searchQuery.text && config.get("elements_status") !== "paid",
    }
  }

  /**
   * This updates the text search input value with the test= parameter from the URL.
   *
   * @param prevProps
   * @param prevState
   */
  componentDidUpdate(prevProps, prevState) {
    const { searchQuery } = this.props
    this.txtRef.value = searchQuery.text ? searchQuery.text : ""
  }

  /**
   * This is a callback that is passed to our Filter component above.
   * It is called whenever a filter is changed (Tag, Color, Background, Orientation).
   * It adjusts the searchQuery prop and passes it up to the searchChanges() callback for URL modification.
   *
   * @param filter
   * @param name
   * @param value
   * @param clearKeys
   */
  searchFilterChange = (filter, name, value, clearKeys) => {
    const { searchQuery, searchChanges } = this.props
    this.setState({ showWelcomeMessage: false })
    const newSearchQuery = { ...searchQuery }
    newSearchQuery[filter] = value ? name : null
    if (clearKeys) {
      for (const clearKey of clearKeys) {
        newSearchQuery[clearKey] = null
      }
    }
    searchChanges(newSearchQuery)
  }

  /**
   * This callback runs when a user performs a text search with the enter key.
   *
   * @param e
   * @returns {boolean}
   */
  doTextSearch = (e) => {
    const { searchQuery, searchChanges } = this.props
    this.setState({ showWelcomeMessage: false })
    const newSearchQuery = { ...searchQuery }
    newSearchQuery.text = this.txtRef.value
    newSearchQuery.tag = null
    newSearchQuery.pg = null
    searchChanges(newSearchQuery)
    if (e) e.preventDefault()
    return false
  }

  licenseChanged = () => {
    this.setState({ showWelcomeMessage: false })
  }

  /**
   * Main render method.
   *
   * @returns {*}
   */
  render() {
    const { apiMeta, layoutOptions, layoutChange, searchQuery } = this.props
    const { showWelcomeMessage } = this.state
    let tagCount = 0
    const maxTagCount = 10

    if (showWelcomeMessage || (typeof window !== "undefined" && window.innerWidth <= 782)) {
      return (
        <div className={styles.wrap}>
          <form onSubmit={this.doTextSearch}>
            <div className={styles.searchText}>
              <input
                id="elements-search-text"
                data-cy="elements-search-text"
                type="text"
                defaultValue={searchQuery.text ? searchQuery.text : ""}
                placeholder="Search..."
                ref={(txt) => {
                  this.txtRef = txt
                }}
                className={`${stylesShared.textInput} ${stylesShared.textInputLarge}`}
                style={{ width: "100%" }}
              />
              <input
                type="submit"
                name="go"
                value="Search"
                className={styles.searchTextSubmit}
                data-cy="elements-search-submit"
              />
            </div>
          </form>
          <div className={styles.intro}>
            <h1 className={styles.introTitle}>Get access to over {apiMeta.totalItemCount} photos</h1>
            <p>
              These photos are brought to you by Envato Elements, and they could be yours! To get unlimited access to
              them and thousands of other digital assets, you need to become a paid Envato Elements subscriber.{" "}
              <a
                href="https://elements.envato.com/?utm_source=extensions&utm_medium=referral&utm_campaign=wordpress_photos_welcome"
                rel="noopener noreferrer"
                target="_blank">
                Find out more
              </a>
            </p>
            <LicenseButton
              label="Get Started"
              successCallback={this.licenseChanged}
              trackingParams={{ utm_content: "photo-welcome" }}
            />
          </div>
        </div>
      )
    }
    return (
      <div className={styles.wrap}>
        <form onSubmit={this.doTextSearch}>
          <div className={styles.searchText}>
            <input
              type="text"
              defaultValue={searchQuery.text}
              placeholder="Search..."
              data-cy="elements-search-text-licensed"
              ref={(txt) => {
                this.txtRef = txt
              }}
              className={`${stylesShared.textInput} ${stylesShared.textInputLarge}`}
              style={{ width: "100%" }}
            />
            <input
              type="submit"
              name="go"
              value="Search"
              className={styles.searchTextSubmit}
              data-cy="elements-search-submit-licensed"
            />
            {apiMeta.totalItemCount ? (
              <div className={styles.searchTotalItems}>Search {apiMeta.totalItemCount} royalty-free stock photos.</div>
            ) : (
              ""
            )}
          </div>
          {apiMeta.aggregations ? (
            <div className={styles.searchFilter}>
              <button
                type="button"
                className={`${styles.viewToggle} ${
                  layoutOptions.display === "fluid" ? styles.viewToggleMasonry : styles.viewToggleGrid
                }`}
                onClick={(e) => {
                  e.preventDefault()
                  layoutChange("display", layoutOptions.display === "fluid" ? "square" : "fluid")
                  return false
                }}>
                View
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="20"
                  height="20"
                  fill="none"
                  viewBox="0 0 20 20"
                  className={styles.viewToggleGridIcon}>
                  <path
                    fill="#888"
                    fillRule="evenodd"
                    d="M2 1h16c.55 0 1 .45 1 1v16c0 .55-.45 1-1 1H2c-.55 0-1-.45-1-1V2c0-.55.45-1 1-1zm7.01 7.99v-6H3v6h6.01zm8 0v-6h-6v6h6zm-8 8.01v-6H3v6h6.01zm8 0v-6h-6v6h6z"
                    clipRule="evenodd"
                  />
                </svg>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="20"
                  height="20"
                  fill="none"
                  viewBox="0 0 20 20"
                  className={styles.viewToggleMasonryIcon}>
                  <path
                    fill="#888"
                    fillRule="evenodd"
                    d="M1 18V2c0-.55.45-1 1-1h16c.55 0 1 .45 1 1v16c0 .55-.45 1-1 1H2c-.55 0-1-.45-1-1zm10-7H3v6h8v-6zM6 3H3v6h3V3zm11 8h-4v6h4v-6zm0-8H8v6h9V3z"
                    clipRule="evenodd"
                  />
                  <mask id="a" width="18" height="18" x="1" y="1" maskUnits="userSpaceOnUse">
                    <path
                      fill="#fff"
                      fillRule="evenodd"
                      d="M1 18V2c0-.55.45-1 1-1h16c.55 0 1 .45 1 1v16c0 .55-.45 1-1 1H2c-.55 0-1-.45-1-1zm10-7H3v6h8v-6zM6 3H3v6h3V3zm11 8h-4v6h4v-6zm0-8H8v6h9V3z"
                      clipRule="evenodd"
                    />
                  </mask>
                  <g mask="url(#a)">
                    <path
                      fill="#0878B0"
                      d="M-0.241 20.816H21.605V41.581H-0.241z"
                      transform="rotate(-90 -.241 20.816)"
                    />
                  </g>
                </svg>
              </button>
              {apiMeta.aggregations.orientation ? (
                <Filter
                  searchFilterChange={this.searchFilterChange}
                  label="Orientation"
                  name="orientation"
                  values={searchQuery}
                  attributes={apiMeta.aggregations.orientation}
                />
              ) : (
                ""
              )}
              {apiMeta.aggregations.background ? (
                <Filter
                  searchFilterChange={this.searchFilterChange}
                  label="Background"
                  name="background"
                  values={searchQuery}
                  attributes={apiMeta.aggregations.background}
                />
              ) : (
                ""
              )}
              {apiMeta.aggregations.colors ? (
                <Filter
                  searchFilterChange={this.searchFilterChange}
                  label="Colors"
                  name="colors"
                  columns={2}
                  values={searchQuery}
                  attributes={apiMeta.aggregations.colors}
                />
              ) : (
                ""
              )}
            </div>
          ) : (
            ""
          )}
          {apiMeta.aggregations && Object.keys(apiMeta.aggregations.tags).length > 0 ? (
            <div className={styles.tagFilter}>
              Related tags:
              {Object.entries(apiMeta.aggregations.tags).map((attribute) =>
                tagCount++ < maxTagCount && attribute[1].label && attribute[1].label.length > 0 ? (
                  <button
                    type="button"
                    key={attribute[0]}
                    className={
                      typeof searchQuery.tag !== "undefined" && searchQuery.tag === attribute[0]
                        ? styles.tagCurrent
                        : styles.tag
                    }
                    onClick={(e) => {
                      e.preventDefault()
                      this.searchFilterChange(
                        "tag",
                        attribute[0],
                        typeof searchQuery.tag === "undefined" || searchQuery.tag !== attribute[0],
                      )
                      return false
                    }}>
                    {attribute[1].label}
                  </button>
                ) : (
                  ""
                ),
              )}
            </div>
          ) : (
            ""
          )}
        </form>
      </div>
    )
  }
}

LibrarySearchPhotos.propTypes = {}
