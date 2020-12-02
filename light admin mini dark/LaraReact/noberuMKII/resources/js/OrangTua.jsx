import React, { Component } from 'react';
import ReactDOM from "react-dom";
import {
  BrowserRouter as Router,
  Switch,
  Route
} from "react-router-dom";
import MobileMenu from "./warudo/MobileMenu";
import Menu from "./warudo/Menu";
import Empatkosongempat from "./warudo/Empatkosongempat";
import DashboardIndex from "./component/dashboard/Index";
import DashboardIndexDua from "./component/dashboarddua/Index";


if (document.getElementById("root")) {
    ReactDOM.render(
        <Router>
            <div className="layout-w">
                <MobileMenu />
                <Menu />
                <Switch>
                    <Route
                        exact
                        path="/"
                        component={DashboardIndex}
                    />
                    <Route
                        exact
                        path="/dashboarddua"
                        component={DashboardIndexDua}
                    />
                    <Empatkosongempat />
                </Switch>
            </div>
        </Router>,

        document.getElementById("root")
    );
}
