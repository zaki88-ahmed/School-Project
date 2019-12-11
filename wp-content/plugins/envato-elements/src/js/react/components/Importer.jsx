import React from "react"

import styles from "./Importer.module.css"
import stylesShared from "../shared.module.css"
import { api } from "../util/api"
import { error } from "../util/error"

export default class Importer extends React.PureComponent {
  constructor(props) {
    super(props)
    this.state = {
      imported: typeof props.item.itemImported !== "undefined" && props.item.itemImported,
      importing: false,
      justImported: false,
      pageName: "",
    }
  }

  doOpen = () => {
    alert("open item page")
  }

  doImport = () => {
    const { updateSingleItem, importData, category, item } = this.props
    this.setState({ importing: true })

    api
      .post(`import/${category}/process`, importData, { retryCallbac: this.doImport })
      .then(
        (json) => {
          if (json && json.status) {
            if (updateSingleItem && json.updateData) updateSingleItem(item, json.updateData)
            this.setState({ imported: true, justImported: true })
          }
        },
        (err) => {

        },
      )
      .finally(() => {
        this.setState({ importing: false })
      })
  }

  createPage = (e) => {
    if(e) e.preventDefault()
    const { importing, pageName } = this.state
    if (importing) return
    const { updateSingleItem, importData, category, item } = this.props
    this.setState({ importing: true, pageCreated: false })

    api
      .post(`create/${category}/process`, Object.assign({}, importData, { pageName }), {
        retryCallbac: this.createPage,
      })
      .then(
        (json) => {
          if (json && json.status) {
            this.setState({ imported: true, pageCreated: json, pageName: "" })
          }
        },
        (err) => {},
      )
      .finally(() => {
        this.setState({ importing: false })
      })
    return false
  }

  pageNameChanged = (e) => {
    this.setState({
      pageName: e.target.value,
    })
  }

  render() {
    const { label, labelImported, item, createPage, labelEnterPageName } = this.props
    const { importing, imported, pageCreated, justImported } = this.state
    if (createPage) {
      return (
        <div className={styles.createPageWrap}>
          {pageCreated ? (
            <div className={styles.createPageSuccess}>
              Congrats! This draft page was just created:{" "}
              <a href={pageCreated.page_url} data-cy="importer-created-page" target="_blank">
                {pageCreated.page_name}
              </a>
            </div>
          ) : null}
          <form onSubmit={this.createPage} className={styles.createPageForm}>
            <input
              onChange={this.pageNameChanged}
              value={this.state.pageName}
              className={stylesShared.textInput}
              disabled={importing}
              placeholder={labelEnterPageName || "Enter Page Name"}
              data-cy="importer-create-page-name"
            />
            <button
              data-cy="importer-create-button"
              onClick={this.createPage}
              className={`${stylesShared.button} ${stylesShared.buttonSecondary} ${styles.createButton} ${
                styles.animatedButton
              } ${styles.animatedButtonSecondary} ${importing ? styles.importing : ""}`}
              disabled={importing}>
              {importing ? "Creating..." : label || "Create New Page"}
              <span />
            </button>
          </form>
        </div>
      )
    }
    return (
      <div className={styles.wrap}>
        {justImported ? (
          <div className={styles.createPageSuccess}>Congrats! This was just imported to the WordPress library.</div>
        ) : null}
        {imported ? (
          <a href={item.itemImportedUrl} className={stylesShared.button}>
            {labelImported || "Open Item"}
          </a>
        ) : (
          <button
            type="button"
            onClick={this.doImport}
            disabled={importing}
            className={`${stylesShared.button} ${styles.animatedButton} ${importing ? styles.importing : ""}`}
            data-cy="importer-button">
            {importing ? "Importing..." : label || "Import"}
            <span />
          </button>
        )}
      </div>
    )
  }
}

Importer.propTypes = {}
