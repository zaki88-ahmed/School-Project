import React, { Component } from "react"
import ReactPaginate from "react-paginate"
import PropTypes from "prop-types"

import styles from "./LibraryResultsLayout.module.css"
import pageTitleStyles from "./LibrarySearch.module.css"
import { config } from "../util/config"

// A custom version of LibraryResultsLayout to separate out premium kits.

export default class LibraryResultsElementorLayout extends Component {
  constructor(props) {
    super(props)
    this.state = {}
  }

  extractPremiumKits = (templateKits) => {
    const premiumKits = []
    const freeKits = templateKits.filter((kit) => {
      if (kit.features && kit.features.premium) {
        premiumKits.push(kit)
        return false
      }
      return true
    })
    return freeKits
  }

  render() {
    const {
      layoutOptions,
      resultsClassName,
      resultsList,
      openItem,
      searchQuery,
      ResultNode,
      updateSingleItem,
      searchChange,
      searchChanges,
      apiData,
      apiMeta,
    } = this.props

    const premiumKits = []
    const freeKits = resultsList.filter((kit) => {
      if (kit.features && kit.features.premium) {
        premiumKits.push(kit)
        return false
      }
      return true
    })

    return (
      <React.Fragment>
        {config.shouldWeShowPremiumContent(searchQuery) && premiumKits.length > 0 ? (
          <div className={styles.highlightedPanel}>
            <div className={pageTitleStyles.pageTitle}>
              <h1 className={pageTitleStyles.pageTitleHeading}>Premium Template Kits for Elementor</h1>
              {apiMeta.item_count ? (
                <div className={pageTitleStyles.pageTitleCount}>
                  {apiMeta.item_count.is_filtered_count
                    ? `${apiMeta.item_count.premium_templates} individual Responsive Page Templates.`
                    : apiMeta.item_count.is_tag_count
                    ? `${apiMeta.item_count.premium_collections} Premium Template Kits, ${
                        apiMeta.item_count.premium_templates
                      } individual Responsive Page Templates.`
                    : `${apiMeta.item_count.premium_collections} Premium Template Kits, ${
                        apiMeta.item_count.premium_templates
                      } individual Responsive Page Templates.`}
                </div>
              ) : (
                ""
              )}
            </div>
            <div className={styles.results}>
              {premiumKits.map((result) => {
                let thisOpenPremiumItem = null
                if (openItem) {
                  if (typeof openItem.collectionId !== "undefined") {
                    thisOpenPremiumItem = openItem.collectionId === result.collectionId ? openItem : null
                  }
                  if (typeof openItem.photoId !== "undefined") {
                    thisOpenPremiumItem = openItem.photoId === result.photoId ? openItem : null
                  }
                  if (typeof openItem.blockGroup !== "undefined") {
                    thisOpenPremiumItem = openItem.blockGroup === result.slug ? openItem : null
                  }
                }
                return <ResultNode {...this.props} result={result} key={result.uuid} openItem={thisOpenPremiumItem} />
              })}
            </div>
          </div>
        ) : null}

        <div className={pageTitleStyles.pageTitle}>
          <h1 className={pageTitleStyles.pageTitleHeading}>Free Template Kits for Elementor</h1>
          {apiMeta.item_count ? (
            <div className={pageTitleStyles.pageTitleCount}>
              {apiMeta.item_count.is_filtered_count
                ? `${apiMeta.item_count.templates} individual Responsive Page Templates.`
                : apiMeta.item_count.is_tag_count
                ? `${apiMeta.item_count.collections} Free Template Kits, ${
                    apiMeta.item_count.templates
                  } individual Responsive Page Templates.`
                : `${apiMeta.item_count.collections} Free Template Kits, over ${
                    apiMeta.item_count.templates
                  } individual Responsive Page Templates.`}
            </div>
          ) : (
            ""
          )}
        </div>
        <div
          className={`${styles.results} ${
            layoutOptions.display === "square" ? styles.resultsSquare : ""
          } ${resultsClassName || ""}`}
          data-cy="results">
          {freeKits.length > 0 ? (
            freeKits.map((result) => {
              let thisOpenItem = null
              if (openItem) {
                if (typeof openItem.collectionId !== "undefined") {
                  thisOpenItem = openItem.collectionId === result.collectionId ? openItem : null
                }
                if (typeof openItem.photoId !== "undefined") {
                  thisOpenItem = openItem.photoId === result.photoId ? openItem : null
                }
                if (typeof openItem.blockGroup !== "undefined") {
                  thisOpenItem = openItem.blockGroup === result.slug ? openItem : null
                }
              }
              return <ResultNode {...this.props} result={result} key={result.uuid} openItem={thisOpenItem} />
            })
          ) : (
            <div className={styles.noResults}>Sorry no results found.</div>
          )}
        </div>
        {apiData.page_number &&
        apiData.total_results &&
        apiData.per_page &&
        apiData.total_results > apiData.per_page ? (
          <ReactPaginate
            previousLabel="Previous"
            nextLabel="Next"
            breakLabel="..."
            breakClassName="break-me"
            pageCount={Math.ceil(apiData.total_results / apiData.per_page)}
            marginPagesDisplayed={2}
            pageRangeDisplayed={5}
            forcePage={parseInt(apiData.page_number, 10) - 1}
            onPageChange={(data) => {
              window.scrollTo(0, 0)
              const dialogContent = jQuery(".dialog-widget-content")
              if (dialogContent.length > 0) {
                dialogContent.get(0).scrollTop = 0
              }
              searchChange("pg", data.selected + 1)
            }}
            containerClassName={styles.pagination}
            pageClassName={styles.paginationItem}
            pageLinkClassName={styles.paginationLink}
            activeClassName={styles.paginationActive}
            disabledClassName={styles.paginationDisabled}
          />
        ) : null}
      </React.Fragment>
    )
  }
}

LibraryResultsElementorLayout.propTypes = {}
