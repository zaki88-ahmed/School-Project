import React, { Component } from "react"
import PropTypes from "prop-types"
import LibraryResults from "./LibraryResults"
import styles from "./Photos.module.css"
import LibraryResultsPhotos from "./LibraryResultsPhotos"
import LibrarySearchPhotos from "./LibrarySearchPhotos"
import splitItemsIntoRows from "../util/splitItemsIntoRows"
import LibraryResultsLayout from './LibraryResultsLayout';

export default class Photos extends Component {
  constructor(props) {
    super(props)

    this.state = {
      category: "photos",
      search: {},
    }
  }

  getBreakpointsImages(items) {
    const breakpoints = [
      // {
      //   breakpoint: "base",
      //   itemsPerRow: 2,
      //   gutterWidth: 1.5,
      // },
      // {
      //   breakpoint: "small",
      //   itemsPerRow: 3,
      //   gutterWidth: 1.5,
      // },
      // {
      //   breakpoint: "medium",
      //   itemsPerRow: 4,
      //   gutterWidth: 1.5,
      // },
      {
        breakpoint: "large",
        itemsPerRow: 5,
        gutterWidth: 1.1,
      },
    ]
    const numberOfRows = Number.MAX_SAFE_INTEGER
    let sliceIndex = 0

    const breakpointsImages = breakpoints.map((breakpoint, i) => {
      const itemRows = splitItemsIntoRows(items, breakpoint.itemsPerRow, numberOfRows)

      const imagesConfig = itemRows.map((itemRow, rowIndex) =>
        itemRow.items.map((item, imageIndex) => {
          const numOfGutters = itemRow.items.length - 1
          const smallLastRow = rowIndex === itemRows.length - 1 && itemRow.size < breakpoint.itemsPerRow * 0.75 // scale up if close enough
          const rowSize = smallLastRow ? breakpoint.itemsPerRow : itemRow.size

          const { aspectRatio = 1 } = item
          const calculatedMasonryWidth = (aspectRatio / rowSize) * (100 - numOfGutters * breakpoint.gutterWidth)

          return {
            ...item,
            calculatedMasonryWidth,
          }
        }),
      )

      if (sliceIndex < imagesConfig.length) sliceIndex = imagesConfig.length

      return {
        breakpoint: {
          ...breakpoint,
          // size: idx(gridBreakpoints, (_) => _[breakpoint.breakpoint]) || 0,
          size: breakpoint.breakpoint || 0,
        },
        images: imagesConfig.flat(),
      }
    })

    return { breakpointsImages, sliceIndex }
  }

  /**
   * Here we calculate the masonry layout for our photos.
   * We group items into "rows" and calculate the row heights at different break points.
   *
   * @param results
   * @returns {Array}
   */
  resultsPreProcessor = (results) => {
    const resultsByRows = this.getBreakpointsImages(results)
    // todo: choose the right breakpoint to return based on viewport.
    return resultsByRows.breakpointsImages[0].images
    // return results
  }

  render() {
    const { categories } = this.props
    const { category, search } = this.state
    return (
      <div className={styles.wrap}>
        <LibraryResults
          ResultsLayout={LibraryResultsLayout}
          ResultNode={LibraryResultsPhotos}
          resultsPreProcessor={this.resultsPreProcessor}
          resultsClassName={styles.results}
          SearchNode={LibrarySearchPhotos}
          category={category}
          search={search}
          {...this.props}
        />
      </div>
    )
  }
}

// export default reloadable( Photos );

Photos.propTypes = {}
