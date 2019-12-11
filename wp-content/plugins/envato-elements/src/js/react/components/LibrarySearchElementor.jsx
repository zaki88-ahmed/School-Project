import React from "react"

import LibrarySearchElementorFilters from "./LibrarySearchElementorFilters"
import { config } from "../util/config"

import styles from "./LibrarySearch.module.css"
import stylesShared from "../shared.module.css"
import LicenseButton from "./LicenseButton"

/**
 * Component for the main search bar at top of page.
 */
export default class LibrarySearchElementor extends React.PureComponent {
  constructor(props) {
    super(props)

    this.state = {
      activeSearch: false,
      textValue: typeof props.searchQuery.text !== "undefined" ? props.searchQuery.text : "",
      showWelcomeMessage: config.get("show_premium_notice") === "yes",
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
  doTextSearch = (e, customTextValue, customTagValue) => {
    const { searchQuery, searchChanges } = this.props
    const { textValue } = this.state
    const newSearchQuery = Object.assign({}, searchQuery)
    newSearchQuery.text = typeof customTextValue !== "undefined" ? customTextValue : textValue
    newSearchQuery.tag = typeof customTagValue !== "undefined" ? customTagValue : null
    newSearchQuery.pg = null
    searchChanges(newSearchQuery)
    if (e) e.preventDefault()
    this.setState({
      activeSearch: false,
    })
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
    this.setState({
      activeSearch: false,
    })
    searchChanges(newSearchQuery)
  }

  autocomplete = (e) => {
    this.setState({
      activeSearch: true,
      textValue: e.target.value,
    })
  }

  licenseChanged = () => {
    this.setState({ showWelcomeMessage: false })
    config.persist("show_premium_notice", "licensed")
  }

  /**
   * Main render method.
   *
   * @returns {*}
   */
  render() {
    const { apiMeta, layoutOptions, layoutChange, searchQuery } = this.props
    const { textValue, activeSearch, showWelcomeMessage } = this.state
    const alreadyPaidSubscriber = config.get("elements_status") === "paid"

    if (config.shouldWeShowPremiumContent(searchQuery) && showWelcomeMessage) {
      return (
        <div className={styles.premiumNotice}>
          <button
            className={styles.premiumCloseButton}
            onClick={() => {
              this.setState({ showWelcomeMessage: false })
              config.persist("show_premium_notice", "dismissed")
            }}>
            <span className="dashicons dashicons-no-alt" />
          </button>
          <div className={styles.premiumText}>
            <h1 className={styles.introTitle}>New - Premium Template Kits</h1>
            <p>
              In addition to our{" "}
              {apiMeta.item_count && apiMeta.item_count.collections ? apiMeta.item_count.collections : 80} Free Template
              Kits, we now have{" "}
              {apiMeta.item_count && apiMeta.item_count.premium_collections
                ? apiMeta.item_count.premium_collections
                : 5}{" "}
              Premium Template Kits that are currently <strong>exclusive to paid, Envato Elements Subscribers!</strong>
            </p>
            {alreadyPaidSubscriber ? (
              <p>
                Becuase you're already a paid Envato Elements Subscriber, you get access to the Premium Template Kits
                right away!
              </p>
            ) : (
              <React.Fragment>
                <p>
                  You can{" "}
                  <a
                    href="https://elements.envato.com/?utm_source=extensions&utm_medium=referral&utm_campaign=wordpress_premium_template_welcome"
                    rel="noopener noreferrer"
                    target="_blank">
                    find out more
                  </a>{" "}
                  about an Envato Elements subscription, if you’re already a subscriber or you’d like to sign up, click
                  the button below.
                </p>
                <LicenseButton
                  label="Get Started"
                  trackingParams={{ utm_content: "template-welcome" }}
                  successCallback={this.licenseChanged}
                />
              </React.Fragment>
            )}
          </div>
          <div className={styles.premiumImage} />
        </div>
      )
    }

    return (
      <div className={styles.wrapBottomSpacing}>
        <form onSubmit={this.doTextSearch} className={styles.searchForm}>
          <div className={styles.searchText}>
            <input
              type="text"
              placeholder="Search..."
              value={textValue}
              onFocus={() => {
                this.setState({
                  activeSearch: true,
                  textValue: "",
                })
              }}
              onBlur={() => {
                setTimeout(() => {
                  this.setState({
                    activeSearch: false,
                  })
                }, 150)
              }}
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
                  this.doTextSearch(false, null, null)
                }}>
                Clear Search
              </button>
            ) : null}
            {activeSearch ? (
              <Industries
                searchText={textValue}
                apiMeta={apiMeta}
                setValue={(text, tag) => {
                  this.setState({
                    activeSearch: false,
                    textValue: text,
                  })
                  this.doTextSearch(false, null, tag)
                }}
              />
            ) : null}
          </div>
          <LibrarySearchElementorFilters
            searchFilterChange={this.searchFilterChange}
            searchQuery={searchQuery}
            allowPremium
          />
        </form>
      </div>
    )
  }
}

LibrarySearchElementor.propTypes = {}

const Industries = ({ searchText, apiMeta, setValue }) => {
  if (apiMeta && apiMeta.filters && apiMeta.filters.industry) {
    const searchTextMatch = new RegExp(searchText, "gi")
    const industries = Object.entries(apiMeta.filters.industry).reduce((accumulator, item) => {
      if (searchText.length > 0 && !item[1].name.match(searchTextMatch)) {
        return accumulator
      }
      return [
        ...accumulator,
        {
          key: item[0],
          name: item[1].name,
          count: item[1].count,
        },
      ]
    }, [])

    return industries.length > 0 ? (
      <div className={styles.autoComplete}>
        {industries
          .sort((a, b) => a.name.localeCompare(b.name))
          .map((industry) => {
            return (
              <div className={styles.autoCompleteEntry} key={industry.key}>
                <button
                  className={styles.autoCompleteButton}
                  onClick={() => {
                    setValue(industry.name, industry.key)
                  }}>
                  {industry.name} ({industry.count})
                </button>
              </div>
            )
          })}
      </div>
    ) : null
  }
  return null
}
