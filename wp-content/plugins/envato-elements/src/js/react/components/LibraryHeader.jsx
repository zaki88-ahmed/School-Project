import React, { Component } from "react"
import PropTypes from "prop-types"
import styles from "./LibraryHeader.module.css"

export default class LibraryHeader extends Component {
  constructor(props) {
    super(props)

    this.state = {
    }
  }

  render() {
    const { title } = this.props
    return (
      <div className={styles.wrap}>
        <h2>{title}</h2>
      </div>
    )
  }
}

LibraryHeader.propTypes = {}
