import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import CreateStyle from './CreateStyle';
import RoutePage from './RoutePage';
import ViewStyles from './ViewStyles';

export default class HomeStyles extends Component {
        render() {
        return (
            <div className="container">
                <div className="row">
                    <div className="col-md-8 col-md-offset-2">
                        <div className="panel panel-default">
                            <div className="panel-heading">Styles <RoutePage params = {this.props.params.id}/> </div>
                            <div className="panel-body">
                                <div> 
                                    {this.props.children || <CreateStyle params = {this.props.params} />}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

