import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { Router, Route, browserHistory, Link } from 'react-router';
import axios from 'axios';

class CreateService extends Component{
    constructor(props){
        super(props);

        this.state = {name:'', image:'', timetaken:''};

        this.changeName = this.changeName.bind(this);
        this.changeImage = this.changeImage.bind(this);
        this.changeTimeTaken = this.changeTimeTaken.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }
    changeName(e){
        this.setState({ name : e.target.value });
    }
    changeTimeTaken(e){
        this.setState({ timetaken: e.target.value });
    }
    changeImage(e){
        this.setState({ image: e.target.files[0] });
    }
    handleSubmit(e){
        e.preventDefault();
        const config = { 
            header: {
                'content-type':'multipart/form-data'
            }
        }
        const service = {
            name : this.state.name,
            time_taken : this.state.timetaken,
            image: this.state.image,
            salon_id: this.props.params.id
        }
        var data = new FormData();
        data.append('name', service.name);
        data.append('time_taken', service.time_taken);
        data.append('image', service.image);
        data.append('salon_id', service.salon_id);
        console.log(data);

        let uri = "http://localhost:8000/service/";

        axios.post(uri, data).then(response=>{
            console.log(response.data);
            browserHistory.push('/services/'+this.props.params.id+"/");
        });
    }
    render(){
        return(
            <div className = "container">
                <form onSubmit={this.handleSubmit}>
                    <div className="row">
                        <div className="col-md-6">
                            <div className="form-group">
                                <label>Service's Name:</label>
                                <input type="text" className="form-control" onChange={this.changeName}/>
                            </div>
                        </div>
                    </div><br/>
                    <div className="row">
                        <div className="col-md-6">
                            <div className="form-group">
                                <label>Service's Image:</label>
                                <input type="file" className="form-control" onChange={this.changeImage}/>
                            </div>
                        </div>
                    </div><br/>
                    <div className="row">
                        <div className="col-md-6">
                            <div className="form-group">
                                <label>Time Taken: </label>
                                <input type="text" className="form-control" onChange={this.changeTimeTaken}/>
                            </div>
                        </div>
                    </div><br/>
                    <div className="row">
                        <div className="col-md-6">
                            <div className="form-group">
                                <button className="btn btn-primary">Add Service</button>
                            </div>
                        </div>
                    </div>
                </form>
            
            </div>
        )
    }
}

export default CreateService;
