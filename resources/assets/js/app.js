
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

require('./components/Example');
require('./components/CreateStyle');
import React from 'react';
import { render } from 'react-dom';
import { Router, Route, browserHistory, hashHistory, Link } from 'react-router';

import Example from './components/Example';
import CreateStyle from './components/CreateStyle';
import ViewStyles from './components/ViewStyles';
import EditStyle from './components/EditStyle';
 
if (document.getElementById('example')) {
    render(
        <Router history={browserHistory}>
            <Route path="/style/:id" component={Example}>
                <Route path={"/style/edit/:id/"} component={EditStyle} />
                <Route path={"/style/:id/add-style"} component={CreateStyle} />
                <Route path={"/style/:id/view-styles"} component={ViewStyles} />
            </Route>
        </Router>,
        document.getElementById('example'));
}
