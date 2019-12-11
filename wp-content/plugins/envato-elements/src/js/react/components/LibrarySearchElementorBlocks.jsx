import React from "react"

import LicenseButton from "./LicenseButton"
import { config } from "../util/config"

import styles from "./LibrarySearch.module.css"
import stylesShared from "../shared.module.css"
import LibrarySearchElementorFilters from "./LibrarySearchElementorFilters"

/**
 * Component for the main search bar at top of page.
 */
export default class LibrarySearchElementorBlocks extends React.PureComponent {
  constructor(props) {
    super(props)

    this.state = {
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
    const newSearchQuery = Object.assign({}, searchQuery)
    newSearchQuery[filter] = value ? name : null
    if (clearKeys) {
      for (const clearKey of clearKeys) {
        newSearchQuery[clearKey] = null
      }
    }
    searchChanges(newSearchQuery)
  }

  autocomplete = (e) => {
    this.setState({
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
    const { textValue } = this.state

    return (
      <div className={styles.outer}>
        <div className={styles.wrapNoBg}>
          <form onSubmit={this.doTextSearch} className={styles.searchForm}>
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
                      textValue: "",
                    })
                    this.doTextSearch(false, "")
                  }}>
                  Clear Search
                </button>
              ) : null}
            </div>
            <LibrarySearchElementorFilters searchFilterChange={this.searchFilterChange} searchQuery={searchQuery} />
          </form>
        </div>
        <div className={styles.pageTitle}>
          <h1 className={styles.pageTitleHeading}>Free Block Kits for Elementor</h1>
          {apiMeta.item_count ? (
            <div className={styles.pageTitleCount}>
              {apiMeta.item_count.is_filtered_count
                ? `${apiMeta.item_count.templates} individual Responsive Block Templates.`
                : `Browse over ${apiMeta.item_count.templates} free Responsive Block Templates.`}
            </div>
          ) : (
            ""
          )}
        </div>
      </div>
    )
  }
}

LibrarySearchElementorBlocks.propTypes = {}
