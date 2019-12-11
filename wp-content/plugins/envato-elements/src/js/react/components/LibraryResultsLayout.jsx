import React, { Component } from "react"
import ReactPaginate from "react-paginate"
import PropTypes from "prop-types"

import styles from "./LibraryResultsLayout.module.css"

export default class LibraryResultsLayout extends Component {
  constructor(props) {
    super(props)
    this.state = {}
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
      apiData,
    } = this.props

    return (
      <React.Fragment>
        <div
          className={`${styles.results} ${
            layoutOptions.display === "square" ? styles.resultsSquare : ""
          } ${resultsClassName || ""}`}
          data-cy="results">
          {resultsList.length > 0 ? (
            resultsList.map((result) => {
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

LibraryResultsLayout.propTypes = {}
