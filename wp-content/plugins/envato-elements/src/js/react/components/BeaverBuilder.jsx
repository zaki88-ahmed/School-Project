import React, { Component } from "react"
import PropTypes from "prop-types"
import LibraryHeader from "./LibraryHeader"
import LibraryResults from "./LibraryResults"
import styles from "./Elementor.module.css"
import LibraryResultsBeaverBuilder from "./LibraryResultsBeaverBuilder"
import LibrarySearchBeaverBuilder from "./LibrarySearchBeaverBuilder"
import LibraryResultsLayout from "./LibraryResultsLayout"

export default class Elementor extends Component {
  constructor(props) {
    super(props)

    this.state = {
      category: "beaver-builder",
      search: {},
    }
  }

  render() {
    const { categories } = this.props
    const { category, search } = this.state
    return (
      <div className={styles.wrap}>
        <LibraryResults
          ResultsLayout={LibraryResultsLayout}
          ResultNode={LibraryResultsBeaverBuilder}
          SearchNode={LibrarySearchBeaverBuilder}
          contentTypeName="Template Kit"
          category={category}
          search={search}
          {...this.props}
        />
      </div>
    )
  }
}

Elementor.propTypes = {}
