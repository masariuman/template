import React, { Component } from "react";
import { NavLink } from "react-router-dom";

class Footer extends Component {
    render() {
        return (
            <div className="menu-w color-scheme-dark color-style-bright menu-position-side menu-side-left menu-layout-mini sub-menu-style-over sub-menu-color-bright selected-menu-color-light menu-activated-on-hover menu-has-selected-link">
                <div className="logo-w">
                    <a className="logo" href="index.html">
                        <div className="logo-element"></div>
                        <div className="logo-label">
                            Clean Admin
                        </div>
                    </a>
                </div>
                <div className="logged-user-w avatar-inline">
                    <div className="logged-user-i">
                        <div className="avatar-w">
                            <img alt="" src="/warudo/dist/img/avatar1.jpg" />
                        </div>
                        <div className="logged-user-info-w">
                            <div className="logged-user-name">
                                MasariuMan
                            </div>
                            <div className="logged-user-role">
                                Administrator
                            </div>
                        </div>
                        <div className="logged-user-toggler-arrow">
                            <div className="os-icon os-icon-chevron-down"></div>
                        </div>
                        <div className="logged-user-menu color-style-bright">
                            <div className="logged-user-avatar-info">
                                <div className="avatar-w">
                                    <img alt="" src="/warudo/dist/img/avatar1.jpg" />
                                </div>
                                <div className="logged-user-info-w">
                                    <div className="logged-user-name">
                                        MasariuMan
                                    </div>
                                    <div className="logged-user-role">
                                        Administrator
                                    </div>
                                </div>
                            </div>
                            <div className="bg-icon">
                                <i className="os-icon os-icon-wallet-loaded"></i>
                            </div>
                            <ul>
                                <li>
                                    <a href="#"><i className="os-icon os-icon-signs-11"></i><span>Logout</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div className="menu-actions">
                    {/* START - Settings Link in secondary top menu */}
                    <div className="top-icon top-settings os-dropdown-trigger os-dropdown-position-right">
                        <i className="os-icon os-icon-ui-46"></i>
                        <div className="os-dropdown">
                            <div className="icon-w">
                                <i className="os-icon os-icon-ui-46"></i>
                            </div>
                            <ul>
                                <li>
                                    <a href="users_profile_small.html"><i className="os-icon os-icon-ui-49"></i><span>Profile Settings</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    {/* END - Settings Link in secondary top menu */}
                </div>
                <div className="element-search autosuggest-search-activator">
                    <input placeholder="Start typing to search..." type="text" />
                </div>
                <h1 className="menu-page-header">
                    Page Header
                </h1>
                <ul className="main-menu">
                    <li className="sub-header">
                        <span>Layouts</span>
                    </li>
                    <li className="selected has-sub-menu">
                        <NavLink
                            exact
                            activeClassName="masariuman-active"
                            to={`/`}
                        >
                            <div className="icon-w">
                                <div className="os-icon os-icon-layout"></div>
                            </div>
                            <span>Dashboard</span>
                        </NavLink>
                        <div className="sub-menu-w">
                            <div className="sub-menu-header">
                                Dashboard
                            </div>
                            <div className="sub-menu-icon">
                                <i className="os-icon os-icon-layout"></i>
                            </div>
                            <div className="sub-menu-i">
                                <ul className="sub-menu">
                                    <li>
                                        <a href="index.html">Dashboard 1</a>
                                    </li>
                                    <li>
                                        <a href="apps_crypto.html">Crypto Dashboard <strong className="badge badge-danger">Hot</strong></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li className=" has-sub-menu">
                        <NavLink
                            activeClassName="masariuman-active"
                            to={`/dashboarddua`}
                        >
                            <div className="icon-w">
                                <div className="os-icon os-icon-layers"></div>
                            </div>
                            <span>Menu Styles</span>
                        </NavLink>
                        <div className="sub-menu-w">
                            <div className="sub-menu-header">
                                Menu Styles
                            </div>
                            <div className="sub-menu-icon">
                                    <i className="os-icon os-icon-layers"></i>
                            </div>
                            <div className="sub-menu-i">
                                <ul className="sub-menu">
                                    <li>
                                        <a href="layouts_menu_side_full.html">Side Menu Light</a>
                                    </li>
                                    <li>
                                        <a href="layouts_menu_side_full_dark.html">Side Menu Dark</a>
                                    </li>
                                </ul>
                                <ul className="sub-menu">
                                    <li>
                                        <a href="layouts_menu_side_mini_dark.html">Mini Menu Dark</a>
                                    </li>
                                    <li>
                                        <a href="layouts_menu_side_compact.html">Compact Side Menu</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        );
    }
}

export default Footer;
