import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import {Router, Route, Link } from 'react-router';

class RoutePage extends Component{
    render() {
        var myStyle = {
            float:'right',
            cursor: 'pointer'
        }
        return(
            <div>
                <span> <Link to={"/style/"+this.props.params.id+"/view-styles"}>View Styles</Link></span>/
                <span> <Link to={"/style/"+this.props.params.id+"/add-style"}>Add Styles</Link></span>
            </div>
        );
    }
}

export default RoutePage;
