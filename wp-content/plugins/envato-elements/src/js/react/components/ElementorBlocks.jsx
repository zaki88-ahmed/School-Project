import React, { Component } from "react"
import PropTypes from "prop-types"
import LibraryResults from "./LibraryResults"
import styles from "./ElementorBlocks.module.css"
import LibraryResultsElementorBlocks from "./LibraryResultsElementorBlocks"
import LibrarySearchElementorBlocks from "./LibrarySearchElementorBlocks"
import LibraryResultsLayout from './LibraryResultsLayout';

export default class Elementor extends Component {
  constructor(props) {
    super(props)

    this.state = {
      category: "elementor-blocks",
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
          ResultNode={LibraryResultsElementorBlocks}
          SearchNode={LibrarySearchElementorBlocks}
          contentTypeName="Block"
          category={category}
          search={search}
          {...this.props}
        />
      </div>
    )
  }
}

// export default reloadable( Elementor );

Elementor.propTypes = {}
