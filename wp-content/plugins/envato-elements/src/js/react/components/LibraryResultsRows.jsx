import React, { Component } from "react"
import PropTypes from "prop-types"

import { disableBodyScroll, enableBodyScroll, clearAllBodyScrollLocks } from "body-scroll-lock"
import OverlayScrollbars from "overlayscrollbars"
import $ from "jquery"
import styles from "./LibraryResultsGroup.module.css"
import LibraryResultsItem from "./LibraryResultsItem"
import LibraryResultsItemOpen from "./LibraryResultsItemOpen"

export default class LibraryResultsGroup extends Component {
  constructor(props) {
    super(props)
    this.scroller = null
    this.groupRef = null
    this.state = {
      isOpen: false,
    }
  }

  componentDidMount() {
    this.itemScroller = OverlayScrollbars(this.scroller, {
      className: "os-theme-thick-dark",
      overflowBehavior: {
        y: "hidden",
      },
      scrollbars: {
        clickScrolling: false, // This is a bit buggy.
        autoHide: "never",
      },
    })

    const { openItem } = this.props
    const { isOpen } = this.state
    if (openItem && !isOpen) {
      this.forceUpdate()
    }
  }

  shouldComponentUpdate(nextProps, nextState) {
    // always update if the display state changes.
    if (this.props.layoutOptions.display !== nextProps.layoutOptions.display) {
      return true
    }

    // Only update if the open state changes of a template
    if (this.props.openItem !== nextProps.openItem) {
      return true
    }
    return false
  }

  scrollCurrentItem = () => {
    // This interval is required when we open a box at the bottom of the page, page grows so we have to keep up with new dom pos.
    const scrollToBox = setInterval(() => {
      if (this.groupRef) {
        window.scrollTo({
          left: 0,
          top: this.groupRef.offsetTop - 70,
        })
      }
    }, 50)
    setTimeout(() => {
      clearInterval(scrollToBox)
    }, 500)
  }

  focusCurrentItem = () => {
    this.scrollCurrentItem()
    if (window.addEventListener) {
      window.addEventListener("resize", this.scrollCurrentItem, true)
    }
  }

  stopFocusCurrentItem = () => {
    window.removeEventListener("resize", this.scrollCurrentItem)
  }

  componentDidUpdate(prevProps, prevState) {
    const { openItem } = this.props
    const { isOpen } = this.state
    if (openItem && !isOpen) {
      this.setState({ isOpen: true })
      disableBodyScroll(this.groupRef)
      this.focusCurrentItem()
    } else if (prevProps.openItem && !openItem) {
      this.setState({ isOpen: false })
      enableBodyScroll(this.groupRef)
      this.stopFocusCurrentItem()
    }
  }

  componentWillUnmount() {
    clearAllBodyScrollLocks()
    this.stopFocusCurrentItem()
  }

  // itemClicked = (item, collection, template) => {
  // history.pushState({}, '', '#/elementor?collectionId=' + collection.collectionId + '&templateId=' + template.templateId);
  // this.itemScroller && this.itemScroller.scroll( this.focusableItem[template.templateId], 400 );
  // }

  render() {
    const { result, openItem, contentTypeName, layoutOptions, getModalPos } = this.props
    if (layoutOptions.display === "square") {
      return (
        <React.Fragment>
          {result.templates.map((template) => {
            return (
              <LibraryResultsItem
                key={template.templateId}
                openItem={openItem}
                layoutOptions={layoutOptions}
                template={template}
                result={result}
                getModalPos={getModalPos}
              />
            )
          })}
        </React.Fragment>
      )
    }
    return (
      <div
        className={`${styles.collection} ${openItem ? styles.collectionOpen : ""}`}
        ref={(group) => (this.groupRef = group)}>
        <section className={styles.single}>
          {openItem ? (
            <div className={styles.singleItem}>
              <LibraryResultsItemOpen openItem={openItem} layoutOptions={layoutOptions} result={result} />
            </div>
          ) : (
            ""
          )}
        </section>
        <section className={styles.summary}>
          <header>
            <h3 className={`${styles.title} ${result.features.new ? styles.new : ""}`}>{result.collectionName}</h3>
            <span className={styles.count}>
              {result.templates.length} {result.templates.length > 1 ? "templates" : "template"}{" "}
              {result.search_template_count
                ? `match out of ${result.search_template_count}`
                : `in this ${contentTypeName}`}
            </span>
          </header>
          <section
            className={styles.scroller}
            ref={(scroller) => {
              this.scroller = scroller
            }}>
            <div className={styles.templates}>
              {result.templates.map((template) => {
                return (
                  <LibraryResultsItem
                    key={template.templateId}
                    layoutOptions={layoutOptions}
                    template={template}
                    result={result}
                  />
                )
              })}
            </div>
          </section>
        </section>
      </div>
    )
  }
}

LibraryResultsGroup.propTypes = {}
