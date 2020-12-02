import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter, Switch, Route, Link } from 'react-router-dom';
import Header from './components/hbxcphyevn/Header';
import Sidebar from './components/hbxcphyevn/Sidebar';
import Footer from './components/hbxcphyevn/Footer';
import Menu1 from './components/menu1/Menu1';
import Menu2 from './components/menu2/Menu2';

if (document.getElementById('root')) {
    ReactDOM.render(
        <BrowserRouter>
            <Header />
            <div className="app-main">
                <Sidebar />
                <div className="app-main__outer">
                    <div className="app-main__inner">
                        <Switch>
                            <Route exact path="/" component={Menu1} />
                            <Route exact path="/menu2" component={Menu2} />
                        </Switch>
                    </div>
                    <Footer />
                </div>
            </div>

        </BrowserRouter>,

        document.getElementById('root')
    );
}
