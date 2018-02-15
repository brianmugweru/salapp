import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import CreateService from './CreateService';
import RoutePage from './RoutePage';
import ViewServices from './ViewServices';

export default class HomeServices extends Component {
    render(){
        return(
            <div className = "container">
                <div className="row">
                    <div className = "col-md-8 col-md-offset-2">
                        <div className = "panel-heading">Services <RoutePage params = {this.props.params.id}/></div>
                        <div className = "panel-body">
                            <div>
                                {this.props.children || <CreateService params = {this.props.params} />}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        )
    }
}
