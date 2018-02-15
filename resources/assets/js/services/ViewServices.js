import React, { Component } from 'react';
import ReactDom from 'react-dom';
import { Router, Route, browserHistory, Link } from 'react-router';
import axiox from 'axios';

class ViewServices extends Component {
    constructor(props){
        super(props);
        this.state = {services:[]};
    }

    componentDidMount(){
        axios.get("http://localhost:8000/services/"+this.props.params.id+"/get")
            .then(response=>{
                console.log(response.data);
                this.setState({services : response.data});
            }).catch(err=>{
                console.log(err)
            });
    }

    render(){
        return(
            <div>
                <table className="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>image</th>
                            <th>Name</th>
                            <th>Time Taken</th>
                            <th>edit</th>
                            <th>delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        {
                            this.state.services.map((service, i) => 
                                <TableRow key= {i} service={service} params={this.props.params.id} />
                            )
                        }
                    </tbody>
                </table>
            </div>
        );
    }
}

class TableRow extends Component{
    constructor(props){
        super(props);
        this.handleSubmit = this.handleSubmit.bind(this);
    }
    componentDidMount(){
        this.setState({_method:'PUT'});
    }
    handleChange1(e){
        this.setState({ method:e.target.value});
    }
    handleSubmit(e){
        e.preventDefault();
        let uri = `http://localhost:8000/service/${this.props.service.id}/delete`;
        let reduri = '/services/'+this.props.params;
        let service = {
            _method:this.state.method
        }
        axios.post(uri,service).then(response=>{
            browserHistory.push(reduri);
        });
    }
    render(){
        return(
            <tr>
                <td>{this.props.service.id }</td>
                <td><img src={`http://localhost:8000/${this.props.service.image}`} /></td>
                <td>{this.props.service.name }</td>
                <td>{this.props.service.time_taken }</td>
                <td><Link to={"/services/edit/"+this.props.service.id+"/"+this.props.params}>Edit</Link></td>
                <td>
                    <form onSubmit={this.handleSubmit}>
                        <input type="hidden" name="_method" value="PUT"/>
                        <input type="submit" value="Delete" className="btn btn-danger btn-sm"/>
                    </form>
                </td>
            </tr>
        );
    }
}

export default ViewServices;
