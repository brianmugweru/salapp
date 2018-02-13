import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { Router, Route, browserHistory, Link } from 'react-router';
import axios from 'axios';

class CreateStyle extends Component {
    constructor(props){
        super(props);
        this.state = {styleName:'', styleImage:'', styleTimeTaken:''};

        this.handleChange1 = this.handleChange1.bind(this);
        this.handleChange2 = this.handleChange2.bind(this);
        this.handleChange3 = this.handleChange3.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }
    handleChange1(e){
        this.setState({
            styleName: e.target.value
        })
    }
    handleChange2(e){
        this.setState({
            styleImage: e.target.files[0]
        })
    }
    handleChange3(e){
        this.setState({
            styleTimeTaken: e.target.value
        })
    }
    handleChange4(e){
        this.setState({
            salon_id : this.state.params.id
        });
    }
    handleSubmit(e){
        e.preventDefault();
        const config = {
            header: {
                'content-type':'multipart/form-data'
            }
        }
        const style = {
            name: this.state.styleName,
            timetaken: this.state.styleTimeTaken,
            image: this.state.styleImage,
            salon_id: this.state.salon_id
        }
        console.log(style);
        var data = new FormData();
        data.append('name', style.name);
        data.append('timetaken', style.timetaken);
        data.append('image', style.image);
        data.append('salon_id', style.salon_id);

        let uri = "http://localhost:8000/style/";

        axios.post(uri, data).then((response)=>{
            console.log(response.data);
            browserHistory.push('/style/'+this.props.params.id+'/view-style');
        });
    }
    render(){
        return(
            <div className="container">
                <form onSubmit={this.handleSubmit}>
                    <div className="row">
                        <div className="col-md-6">
                            <div className="form-group">
                                <label>Style's Name:</label>
                                <input type="text" className="form-control" onChange={this.handleChange1}/>
                            </div>
                        </div>
                    </div><br/>
                    <div className="row">
                        <div className="col-md-6">
                            <div className="form-group">
                                <label>Style's Image:</label>
                                <input type="file" className="form-control" onChange={this.handleChange2}/>
                            </div>
                        </div>
                    </div><br/>
                    <div className="row">
                        <div className="col-md-6">
                            <div className="form-group">
                                <label>Time Taken: </label>
                                <input type="text" className="form-control" onChange={this.handleChange3}/>
                                <input type="hidden" className="form-control" onChange={this.handleChange4}/>
                            </div>
                        </div>
                    </div><br/>
                    <div className="row">
                        <div className="col-md-6">
                            <div className="form-group">
                                <button className="btn btn-primary">Add Style</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        )
    }    
}
export default CreateStyle;

