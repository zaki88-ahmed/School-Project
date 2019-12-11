import React, { Component } from "react"
import PropTypes from "prop-types"
import { Link } from "react-router-dom"

export default class App extends Component {
  constructor(props) {
    super(props)

    this.state = {
    }
  }

  render() {
    return (
      <div className="wrap">
        <h1 style={{ textAlign: "center", padding: "20px", color: "#CCC" }}>Plugin Home Page</h1>
        <p>
          Hey check out our cool <Link to="/photos">Photos</Link> or <Link to="/elementor">Page Template Kits</Link>{" "}
        </p>
      </div>
    )
  }
}

App.propTypes = {}
