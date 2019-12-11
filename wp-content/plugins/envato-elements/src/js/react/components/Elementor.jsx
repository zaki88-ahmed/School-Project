import React, { Component } from "react"
import PropTypes from "prop-types"
import LibraryHeader from "./LibraryHeader"
import LibraryResults from "./LibraryResults"
import styles from "./Elementor.module.css"
import LibraryResultsElementor from "./LibraryResultsElementor/index"
import LibrarySearchElementor from "./LibrarySearchElementor"
import LibraryResultsLayout from "./LibraryResultsElementorLayout"

export default class Elementor extends Component {
  constructor(props) {
    super(props)

    this.state = {
      category: "elementor",
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
          ResultNode={LibraryResultsElementor}
          SearchNode={LibrarySearchElementor}
          contentTypeName="Template Kit"
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
