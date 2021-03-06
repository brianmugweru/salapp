import React, { Component } from 'react';
import ReactDom from 'react-dom';
import { Router, Route, browserHistory, Link } from 'react-router';
import axiox from 'axios';

class ViewStyles extends Component {
    constructor(props){
        super(props);
        this.state = {styles:[]};
    }

    componentDidMount(){
        axios.get("http://localhost:8000/dashboard/styles/"+this.props.params.id+"/get")
            .then(response=>{
                console.log(response.data);
                this.setState({styles : response.data});
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
                            this.state.styles.map((style, i) => 
                                <TableRow key= {i} style={style} params={this.props.params.id} />
                            )
                        }
                    </tbody>
                </table>
            </div>
        );
    }
}
function Handleimage(props){
    var link = props.link.replace('public','storage');
    return <img src = {link} width="40" height="40"/>
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
        let uri = `http://localhost:8000/style/${this.props.style.id}/delete`;
        let reduri = '/styles/'+this.props.params;
        let style = {
            _method:this.state.method
        }
        axios.post(uri,style).then(response=>{
            browserHistory.push(reduri);
        });
    }
    
    render(){
        return(
            <tr>
                <td>{this.props.style.id }</td>
                <td><Handleimage link={`/${this.props.style.image}`}/></td>
                <td>{this.props.style.name }</td>
                <td>{this.props.style.time_taken }</td>
                <td><Link to={"/dashboard/styles/edit/"+this.props.style.id+"/"+this.props.params}>Edit</Link></td>
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

export default ViewStyles;
