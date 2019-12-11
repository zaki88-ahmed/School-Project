import React from "react"

import { config } from "../util/config"

import styles from "./LibrarySearch.module.css"

export default class LibrarySearchElementorFilters extends React.PureComponent {
  render() {
    const { searchQuery, searchFilterChange, allowPremium } = this.props
    return (
      <div className={styles.searchBasicFilters}>
        <div className={styles.filter}>
          <div className={styles.filterLabel}>
            Filter
            <div className={styles.filterAttributes}>
              {allowPremium ? (
                <div className={styles.filterAttribute}>
                  <label htmlFor="filterPremiumTemplates">
                    <input
                      type="checkbox"
                      className={styles.filterAttributeCheckbox}
                      name="premium"
                      value="show"
                      checked={config.shouldWeShowPremiumContent(searchQuery)}
                      id="filterPremiumTemplates"
                      onChange={(e) => {
                        searchFilterChange("premium", e.target.checked ? "show" : "hide", true)
                      }}
                    />
                    Show Premium Template Kits
                  </label>
                </div>
              ) : null}
              <div className={styles.filterAttribute}>
                <label htmlFor="filterElementorPro">
                  <input
                    type="checkbox"
                    className={styles.filterAttributeCheckbox}
                    name="elementor"
                    value="pro"
                    checked={config.shouldWeShowElementorProContent(searchQuery)}
                    id="filterElementorPro"
                    onChange={(e) => {
                      searchFilterChange("elementor", e.target.checked ? "pro" : "free", true)
                    }}
                  />
                  Show Elementor Pro Templates
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>
    )
  }
}
