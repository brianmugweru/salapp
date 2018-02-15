import React, { Component } from 'react';
import axios from 'axios';
import { Link } from 'react-router';

class EditService extends Component{
    constructor(props){
        super(props);
        this.state = { name:'', timetaken:''}

        this.changeName = this.changeName.bind(this);
        this.changeTimeTaken = this.changeTimeTaken.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }
    componentDidMount(){
        axios.get(`http://localhost:8000/service/${this.props.params.serviceid}/edit`)
            .then(response=>{
                console.log(response.data);
                this.setState({name:response.data[0].name, timetaken:response.data[0].time_taken});
            }).catch(err=>{
                console.log(err);
            });
    }
    changeName(e){ 
        this.setState({ name: e.target.value }); 
    }
    changeTimeTaken(e){
        this.setState({ timetaken: e.target.value }); 
    }
    handleSubmit(e){
        e.preventDefault();
        const service = {
            name: this.state.name,
            time_taken: this.state.timetaken
        }
        let uri = 'http://localhost:8000/service/'+this.props.params.serviceid+'/update/';
        let serviceuri = '/services/'+this.props.params.salonid;
        axios.post(uri, service).then(response=>{
            this.props.history.push(serviceuri);
        });
    }

    render(){
        return(
            <div>
                <h1>Update Service</h1>
                <form onSubmit = {this.handleSubmit}>
                    <div className = "form-group">
                        <label>Service Name</label>
                        <input  type="text" className="form-control" value={this.state.name} onChange={this.changeName} />
                    </div>
                    <div className = "form-group">
                        <label>Service time Taken</label>
                        <input type="text" className="form-control" value={this.state.timetaken} onChange={this.changeTimeTaken} />
                    </div>
                    <div className = "form-group">
                        <button className="btn btn-primary">update</button>
                    </div>
                </form>
            
            </div>
        )
    }
}
export default EditService;
