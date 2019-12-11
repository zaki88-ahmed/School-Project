import React from "react"

import styles from "./LoadingSpinner.module.css"

const LoadingSpinner = () => (
  <div className={styles.wrap}>
    <span className={styles.inner} aria-label="Loading" />
  </div>
)

export default LoadingSpinner
