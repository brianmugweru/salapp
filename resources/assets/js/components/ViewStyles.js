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
        axios.get("http://localhost:8000/styles/"+this.props.params.id)
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
                            <th>Name</th>
                            <th>Time Taken</th>
                            <th>edit</th>
                            <th>delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        {
                            this.state.styles.map((style, i) => 
                                <TableRow key= {i} style={style} />
                            )
                        }
                    </tbody>
                </table>
            </div>
        );
    }
}

class TableRow extends Component{
    render(){
        return(
            <tr>
                <td>{this.props.style.id }</td>
                <td>{this.props.style.name }</td>
                <td>{this.props.style.time_taken }</td>
                <td><Link to={"/style/edit/"+this.props.style.id+"/"}>Edit</Link></td>
                <td><button className="btn btn-danger btn-sm">Delete</button></td>
            </tr>
        );
    }
}

export default ViewStyles;
