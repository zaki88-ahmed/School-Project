import React, { Component } from "react"
import ReactPaginate from "react-paginate"
import PropTypes from "prop-types"

import queryString from "query-string"
import { api } from "../util/api"
import { error } from "../util/error"
import styles from "./LibraryResults.module.css"
import LoadingSpinner from "./LoadingSpinner"
import { getListOfMissingPlugins } from '../util/requiredPlugins';

export default class LibraryResults extends Component {
  constructor(props) {
    super(props)
    this.state = {
      firstLoad: true,
      loading: true,
      openItem: {},
      apiData: {},
      apiMeta: {},
      searchQuery: {},
      searchCategory: props.category,
      layoutOptions: {
        display: "fluid",
      },
    }
  }

  static getDerivedStateFromProps(nextProps, prevState) {
    const queryVars = queryString.parse(nextProps.location.search)
    const newSearchQuery = Object.assign({}, queryVars)
    return {
      layoutOptions: {
        display: typeof queryVars.display !== "undefined" ? queryVars.display : "fluid",
      },
      searchQuery: newSearchQuery,
    }
  }

  componentDidUpdate(prevProps, prevState) {
    // We don't want to re-run a search based on a display change.
    const cloneA = Object.assign({}, prevState.searchQuery)
    delete cloneA.display
    const cloneB = Object.assign({}, this.state.searchQuery)
    delete cloneB.display
    if (JSON.stringify(cloneA) !== JSON.stringify(cloneB)) {
      let forceSearchRun = false
      if (prevState.searchQuery.elementor !== this.state.searchQuery.elementor) {
        forceSearchRun = true
      }
      this.searchRun(forceSearchRun)
    }
  }

  componentDidMount() {
    // First search when page loads.
    this.searchRun()
  }

  searchChanges = (searchParams) => {
    this.updateURL(Object.assign({}, this.state.searchQuery, searchParams))
  }

  searchChange = (action, value) => {
    const { searchQuery } = this.state
    searchQuery[action] = value
    this.updateURL(searchQuery)
  }

  // Toggle different types of layout.
  layoutChange = (layoutOption, layoutValue) => {
    this.setState((prevState) => ({
      layoutOptions: {
        ...prevState.layoutOptions,
        [layoutOption]: layoutValue,
      },
    }))
    this.searchChange(layoutOption, layoutValue)
  }

  updateURL = (searchQuery) => {
    const queryVars = queryString.parse(window.location.search)
    Object.keys(queryVars).forEach((key) => queryVars[key] == null && delete queryVars[key])
    Object.keys(searchQuery).forEach((key) => searchQuery[key] == null && delete searchQuery[key])
    if (JSON.stringify(queryVars) !== JSON.stringify(searchQuery)) {
      this.props.history.push({
        search: `?${Object.keys(searchQuery)
          .map((key) => {
            if (searchQuery[key] && searchQuery[key] !== "false") {
              return `${key}=${searchQuery[key]}`
            }
          })
          .join("&")}`,
      })
    }
  }

  hydradeData = (data) => {
    if(typeof envato_elements_react !== 'undefined' && data.results){
      // Hydrade the individual template install status
      data.results.map((collection) => {
        if(collection.templates) {
          return collection.templates.map( ( template ) => {
            const isThisTemplateImported = envato_elements_react.imported_templates && envato_elements_react.imported_templates.find( importedTemplate => template.templateId === importedTemplate.templateId )
            if ( isThisTemplateImported ) {
              template.itemImported = true
              template.itemImportedUrl = isThisTemplateImported.itemImportedUrl
              template.templateInserted = isThisTemplateImported.links
            }
            template.missingPlugins = getListOfMissingPlugins( template.plugins )
            return template
          } )
        }else if(collection.blocks) {
          return collection.blocks.map( ( template ) => {
            const isThisTemplateImported = envato_elements_react.imported_templates && envato_elements_react.imported_templates.find( importedTemplate => template.templateId === importedTemplate.templateId )
            if ( isThisTemplateImported ) {
              template.itemImported = true
              template.itemImportedUrl = isThisTemplateImported.itemImportedUrl
              template.templateInserted = isThisTemplateImported.links
            }
            template.missingPlugins = getListOfMissingPlugins( template.plugins )
            return template
          } )
        }else{
          return collection
        }
      })
    }
    return data;
  }

  searchRun = (forceSearchRun) => {
    // window.scrollTo( 0, 0 );

    const { searchCategory, searchQuery, apiData, openItem } = this.state

    // Are we opening up a collection/template?
    if (typeof apiData.results !== "undefined" && !forceSearchRun) {
      if (typeof searchQuery.photoId !== "undefined" && searchQuery.photoId) {
        // do we already have this rendered on the page? just change our stage.
        // if we don't have it on the page then we need to do a new query below
        for (const existingPhoto of apiData.results) {
          if (existingPhoto.photoId === searchQuery.photoId) {
            this.setState({
              openItem: {
                photoId: existingPhoto.photoId,
              },
            })
            return
          }
        }
      } else if (typeof searchQuery.collectionId !== "undefined" && searchQuery.collectionId) {
        // do we already have this rendered on the page? just change our stage.
        // if we don't have it on the page then we need to do a new query below
        for (const existingCollection of apiData.results) {
          if (existingCollection.collectionId === searchQuery.collectionId) {
            this.setState({
              openItem: {
                collectionId: existingCollection.collectionId,
                templateId: searchQuery.templateId,
              },
            })
            return
          }
        }
      } else if (typeof searchQuery.blockGroup !== "undefined" && searchQuery.blockGroup) {
        // do we already have this rendered on the page? just change our stage.
        // if we don't have it on the page then we need to do a new query below
        for (const existingBlockGroup of apiData.results) {
          if (existingBlockGroup.slug === searchQuery.blockGroup) {
            this.setState({
              openItem: {
                blockGroup: existingBlockGroup.slug,
              },
            })
            return
          }
        }
      } else {
        // Just closing an already open item, no need to do a full API search again
        if (openItem && apiData.results.length > 1) {
          this.setState({
            openItem: null,
          })
          return
        }
      }
    }

    this.setState({ loading: true })

    api
      .post(
        `collections/${searchCategory}`,
        {
          elementsSearch: {
            ...searchQuery,
            category: searchCategory,
            pg: parseInt(typeof searchQuery.pg !== "undefined" ? searchQuery.pg : 1),
          },
        },
        { abortExisting: true, cacheResults: true, retryCallback: this.searchRun },
      )
      .then(
        (json) => {
          if (json && json.data) {

            // We modify this JSON data client side, based on data available from get_public_settings()
            const jsonData = this.hydradeData(json.data)

            this.setState({
              openItem: json.openItem ? json.openItem : null,
              apiData: json.data,
              apiMeta: json.meta,
            })
            this.setState({ firstLoad: false, loading: false })
          } else {
            error.displayError(
              "Search JSON Error",
              json && typeof json.message !== "undefined"
                ? json.message
                : json && typeof json.error !== "undefined"
                ? json.error
                : "Sorry something went wrong.",
              json,
              false,
              this.searchRun,
            )
          }
        },
        (err) => {
          if (err && err.aborted) {
            return
          }
          if (err && typeof err.code !== "undefined" && err.code === "rest_cookie_invalid_nonce") {
            error.displayError("API Token Expired", "Refreshing please wait...")
            setTimeout(function() {
              window.location.reload()
            }, 500)
          }
        },
      )
      .finally(() => {})
  }

  isApiRefreshNeeded = () => {
    return true
  }

  /**
   * This is called after importing an item. It will allow us to re-render imported flags etc..
   *
   * @param itemId
   * @param changedData
   */
  updateSingleItem = (item, changedData) => {
    const { apiData } = this.state
    if (typeof apiData.results !== "undefined") {
      let found = false
      const newApiData = Object.assign({}, apiData)
      for (const i in newApiData.results) {
        if (typeof newApiData.results[i].templates !== "undefined") {
          for (const maybeItem in newApiData.results[i].templates) {
            if (newApiData.results[i].templates[maybeItem] === item) {
              newApiData.results[i].templates[maybeItem] = Object.assign(
                newApiData.results[i].templates[maybeItem],
                changedData,
              )
              found = true
            }
          }
        } else if (typeof newApiData.results[i].blocks !== "undefined") {
          for (const maybeItem in newApiData.results[i].blocks) {
            if (newApiData.results[i].blocks[maybeItem] === item) {
              newApiData.results[i].blocks[maybeItem] = Object.assign(
                newApiData.results[i].blocks[maybeItem],
                changedData,
              )
              found = true
            }
          }
        } else if (
          (typeof item.uuid !== "undefined" && item.uuid === newApiData.results[i].uuid) ||
          newApiData.results[i] === item
        ) {
          // Check for photos on uuid, as that object is mutated for masonary
          newApiData.results[i] = Object.assign(newApiData.results[i], changedData)
          found = true
        }
      }
      if (found) {
        this.setState({ apiData: newApiData })
      }
    }
  }

  render() {
    const { SearchNode, ResultNode, ResultsLayout, resultsPreProcessor, resultsClassName } = this.props
    const { apiData, searchQuery, apiMeta, firstLoad, loading, layoutOptions, openItem } = this.state
    if (firstLoad)
      return (
        <div className={`${styles.wrap} ${styles.loading}`}>
          <LoadingSpinner />
        </div>
      )

    const resultsList = resultsPreProcessor ? resultsPreProcessor(apiData.results) : apiData.results

    return (
      <div className={styles.wrap}>
        {SearchNode ? (
          <SearchNode
            apiMeta={apiMeta}
            searchQuery={searchQuery}
            searchChanges={this.searchChanges}
            layoutChange={this.layoutChange}
            layoutOptions={layoutOptions}
          />
        ) : null}
        {loading ? (
          <LoadingSpinner />
        ) : (
          <ResultsLayout
            layoutOptions={layoutOptions}
            resultsClassName={resultsClassName}
            resultsList={resultsList}
            openItem={openItem}
            searchQuery={searchQuery}
            ResultNode={ResultNode}
            updateSingleItem={this.updateSingleItem}
            searchChange={this.searchChange}
            searchChanges={this.searchChanges}
            apiData={apiData}
            apiMeta={apiMeta}
            {...this.props}
          />
        )}
      </div>
    )
  }
}

LibraryResults.propTypes = {}
