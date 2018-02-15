
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

require('./bootstrap');
/**
 * Next, we will create a fresh React component instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

require('./components/HomeStyles');
require('./components/CreateStyle');
import React from 'react';
import { render } from 'react-dom';
import { Router, Route, browserHistory, IndexRoute, Link } from 'react-router';

import HomeStyles from './components/HomeStyles';
import CreateStyle from './components/CreateStyle';
import ViewStyles from './components/ViewStyles';
import EditStyle from './components/EditStyle';

import HomeServices from './services/HomeServices';
import CreateService from './services/CreateService';
import ViewServices from './services/ViewServices';
import EditService from './services/EditService';
 
if (document.getElementById('styles')) {
    render(
        <Router history={browserHistory}>
            <Route path="/styles/:id" component={HomeStyles}>
                <IndexRoute component={ViewStyles}/>
                <Route path={"/styles/edit/:styleid/:salonid"} component={EditStyle} />
                <Route path={"/styles/:id/add-style"} component={CreateStyle} />
                <Route path={"/styles/:id/view-styles"} component={ViewStyles} />
            </Route>
        </Router>,
        document.getElementById('styles')
    );
} 
else if (document.getElementById('services')){
    render(
        <Router history={browserHistory}>
            <Route path="/services/:id" component={HomeServices}>
                <IndexRoute component={ViewServices} />
                <Route path={"/services/edit/:serviceid/:salonid"} component={EditService} />
                <Route path={"/services/:id/add-service"} component={CreateService} />
                <Route path={"/services/:id/view-services"} component={ViewServices} />
            </Route>
        </Router>,
        document.getElementById('services')
    );
}
