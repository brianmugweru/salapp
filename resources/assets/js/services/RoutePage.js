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
                <span> <Link to={"/services/"+this.props.params+"/view-services"}>View Services</Link></span>/
                <span> <Link to={"/services/"+this.props.params+"/add-service"}>Add Service</Link></span>
                <span style={myStyle}> <a href={"/salon/"+this.props.params}>View Salon </a></span>
            </div>
        );
    }
}

export default RoutePage;
