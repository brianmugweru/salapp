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
                <span> <Link to={"/dashboard/styles/"+this.props.params}>View Styles</Link></span>/
                <span> <Link to={"/dashboard/styles/"+this.props.params+"/add-style"}>Add Style</Link></span>
                <span style={myStyle}> <a href={"/salon/"+this.props.params}>View Salon </a></span>
            </div>
        );
    }
}

export default RoutePage;
