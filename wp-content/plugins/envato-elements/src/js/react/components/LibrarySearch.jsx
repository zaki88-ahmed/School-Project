import React, { Component } from "react"
import PropTypes from "prop-types"

import queryString from "query-string"
import { api } from "../util/api"
import { error } from "../util/error"
import styles from "./LibrarySearch.module.css"

export default class LibrarySearch extends Component {
  constructor(props) {
    super(props)
    this.state = {}
  }

  render() {
    return <div className={styles.searchBar}>Search Bar</div>
  }
}

LibrarySearch.propTypes = {}
