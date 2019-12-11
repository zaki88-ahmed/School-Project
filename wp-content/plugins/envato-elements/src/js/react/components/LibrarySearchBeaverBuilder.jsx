import React from "react"

import LicenseButton from "./LicenseButton"
import { config } from "../util/config"

import styles from "./LibrarySearch.module.css"
import stylesShared from "../shared.module.css"

/**
 * Component for the main search bar at top of page.
 */
export default class LibrarySearchBeaverBuilder extends React.PureComponent {
  constructor(props) {
    super(props)

    this.state = {
      activeSearch: false,
      textValue: typeof props.searchQuery.text !== "undefined" ? props.searchQuery.text : "",
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
    // this.txtRef.value = searchQuery.text ? searchQuery.text : ""
  }

  /**
   * This callback runs when a user performs a text search with the enter key.
   *
   * @param e
   * @returns {boolean}
   */
  doTextSearch = (e, customTextValue) => {
    const { searchQuery, searchChanges } = this.props
    const { textValue } = this.state
    const newSearchQuery = Object.assign({}, searchQuery)
    newSearchQuery.text = typeof customTextValue !== "undefined" ? customTextValue : textValue
    newSearchQuery.tag = null
    newSearchQuery.pg = null
    searchChanges(newSearchQuery)
    if (e) e.preventDefault()
    return false
  }

  autocomplete = (e) => {
    this.setState({
      activeSearch: true,
      textValue: e.target.value,
    })
  }

  /**
   * Main render method.
   *
   * @returns {*}
   */
  render() {
    const { apiMeta, layoutOptions, layoutChange, searchQuery } = this.props
    const { textValue, activeSearch } = this.state
    return (
      <div className={styles.outer}>
        <div className={styles.wrapNoBg}>
          <form onSubmit={this.doTextSearch}>
            <div className={styles.searchText}>
              <input
                type="text"
                placeholder="Search..."
                value={textValue}
                onChange={this.autocomplete}
                className={`${stylesShared.textInput} ${stylesShared.textInputLarge}`}
                style={{ width: "100%" }}
              />
              <input type="submit" name="go" value="Search" className={styles.searchTextSubmit} />
              {textValue.length > 0 ? (
                <button
                  type="button"
                  name="reset"
                  className={styles.searchTextReset}
                  onClick={() => {
                    this.setState({
                      activeSearch: false,
                      textValue: "",
                    })
                    this.doTextSearch(false, "")
                  }}>
                  Clear Search
                </button>
              ) : null}
            </div>
          </form>
        </div>
        <div className={styles.pageTitle}>
          <h1 className={styles.pageTitleHeading}>Free Template Kits for Beaver Builder</h1>
          {apiMeta.item_count ? (
            <div className={styles.pageTitleCount}>
              {apiMeta.item_count.collections} Free Template Kits, over {apiMeta.item_count.templates} individual Page
              Templates.
            </div>
          ) : (
            ""
          )}
        </div>
      </div>
    )
  }
}

LibrarySearchBeaverBuilder.propTypes = {}

