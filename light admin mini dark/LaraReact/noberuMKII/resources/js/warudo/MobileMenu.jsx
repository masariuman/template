import React, { Component } from "react";

class MobileMenu extends Component {
    render() {
        return (
            <div className="menu-mobile menu-activated-on-click color-scheme-dark">
                <div className="mm-logo-buttons-w">
                    <a className="mm-logo" href="index.html">
                        <img src="/warudo/dist/img/logo.png" />
                        <span>Clean Admin</span>
                    </a>
                    <div className="mm-buttons">
                        <div className="content-panel-open">
                            <div className="os-icon os-icon-grid-circles"></div>
                        </div>
                        <div className="mobile-menu-trigger">
                            <div className="os-icon os-icon-hamburger-menu-1"></div>
                        </div>
                    </div>
                </div>
                <div className="menu-and-user">
                    <div className="logged-user-w">
                        <div className="avatar-w">
                            <img alt="" src="/warudo/dist/img/avatar1.jpg" />
                        </div>
                        <div className="logged-user-info-w">
                            <div className="logged-user-name">
                                Maria Gomez
                            </div>
                            <div className="logged-user-role">
                                Administrator
                            </div>
                        </div>
                    </div>
                    {/* START - Mobile Menu List */}
                    <ul className="main-menu">
                        <li className="has-sub-menu">
                            <a href="index.html">
                                <div className="icon-w">
                                    <div className="os-icon os-icon-layout"></div>
                                </div>
                                <span>Dashboard</span>
                            </a>
                            <ul className="sub-menu">
                                <li>
                                    <a href="index.html">Dashboard 1</a>
                                </li>
                                <li>
                                    <a href="apps_crypto.html">Crypto Dashboard <strong className="badge badge-danger">Hot</strong></a>
                                </li>
                                <li>
                                    <a href="apps_support_dashboard.html">Dashboard 3</a>
                                </li>
                                <li>
                                    <a href="apps_projects.html">Dashboard 4</a>
                                </li>
                                <li>
                                    <a href="apps_bank.html">Dashboard 5</a>
                                </li>
                                <li>
                                    <a href="layouts_menu_top_image.html">Dashboard 6</a>
                                </li>
                            </ul>
                        </li>
                        <li className="has-sub-menu">
                            <a href="layouts_menu_top_image.html">
                                <div className="icon-w">
                                    <div className="os-icon os-icon-layers"></div>
                                </div>
                                <span>Menu Styles</span>
                            </a>
                            <ul className="sub-menu">
                                <li>
                                    <a href="layouts_menu_side_full.html">Side Menu Light</a>
                                </li>
                                <li>
                                    <a href="layouts_menu_side_full_dark.html">Side Menu Dark</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    {/* END - Mobile Menu List */}
                    <div className="mobile-menu-magic">
                        <h4>
                            Light Admin
                        </h4>
                        <p>
                            Clean Bootstrap 4 Template
                        </p>
                        <div className="btn-w">
                            <a className="btn btn-white btn-rounded" href="https://themeforest.net/item/light-admin-clean-bootstrap-dashboard-html-template/19760124?ref=Osetin" target="_blank">Purchase Now</a>
                        </div>
                    </div>
                </div>
            {/* END - Mobile Menu */}
            </div>
        );
    }
}

export default MobileMenu;
