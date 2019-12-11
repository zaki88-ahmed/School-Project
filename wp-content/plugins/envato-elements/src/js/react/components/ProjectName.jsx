import React, { Component } from "react"

import styles from "./ProjectName.module.css"
import { modal } from "../util/modal"
import { config } from "../util/config"

export default class ProjectName extends Component {
  constructor(props) {
    super(props)
    this.iconRef = null
    this.txt = null
    this.state = {
      projectNameEdit: false,
      projectName: config.get("elements_project"),
    }
  }

  updateProjectName = (e) => {
    const { projectName } = this.state
    if (projectName !== this.txt.innerText) {
      this.setState({ projectName: this.txt.innerText })
      if (this.iconRef) {
        this.iconRef.className = "dashicons dashicons-update"
      }
      if (this.txt.innerText.length > 0) {
        config.persist("elements_project", this.txt.innerText).then(
          () => {
            if (this.iconRef) {
              this.iconRef.className = "dashicons dashicons-yes"
            }
          },
          () => {},
        )
      }
    }
  }

  shouldComponentUpdate(nextProps, nextState, nextContext) {
    // Otherwise our contentEditable div looses its location input
    return false
  }

  editProjectName = () => {
    this.txt.focus()
    document.execCommand("selectAll", false, null)
  }

  render() {
    const { projectName } = this.state

    return (
      <span className={styles.wrap}>
        <span
          className={styles.projectNameView}
          contentEditable
          onInput={this.updateProjectName}
          onBlur={this.updateProjectName}
          onKeyPress={(e) => {
            const keycode = e.charCode || e.keyCode
            if (keycode === 13) {
              e.preventDefault()
              return false
            }
          }}
          ref={(txt) => {
            this.txt = txt
          }}
          dangerouslySetInnerHTML={{ __html: projectName }}
        />
        <button type="text" onClick={this.editProjectName} className={styles.projectNameButton}>
          <span
            ref={(icon) => {
              this.iconRef = icon
            }}
            className="dashicons dashicons-edit"
          />
        </button>
      </span>
    )
  }
}

ProjectName.propTypes = {}
