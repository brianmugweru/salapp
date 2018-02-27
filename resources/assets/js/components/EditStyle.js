import React, {Component} from 'react';
import axios from 'axios';
import { Link } from 'react-router';

class EditStyle extends Component{
    constructor(props){
        super(props);
        this.state = {name:'',time_taken:''};
        this.handleChange1 = this.handleChange1.bind(this);
        this.handleChange2 = this.handleChange2.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }
    componentDidMount(){
        axios.get(`http://localhost:8000/style/${this.props.params.styleid}/edit`)
            .then(response=>{
                this.setState({name:response.data[0].name,time_taken:response.data[0].time_taken});
            }).catch(err=>{
                console.log(err);
            });
    }

    handleChange1(e){
        this.setState({ name: e.target.value });
    }
    handleChange2(e){
        this.setState({ time_taken: e.target.value });
    }
    handleSubmit(e){
        e.preventDefault();
        const style = {
            name: this.state.name,
            time_taken: this.state.time_taken
        }
        let uri = 'http://localhost:8000/dashboard/style/'+this.props.params.styleid+'/update/';
        let styleuri = '/styles/'+this.props.params.salonid;
        axios.post(uri, style).then(response=>{
            this.props.history.push(styleuri);
        });
    }

    render(){
        return(
            <div>
                <h1>Update Style</h1>
                <form onSubmit = {this.handleSubmit}>
                    <div className = "form-group">
                        <label>Style Name</label>
                        <input  type="text" className="form-control" value={this.state.name} onChange={this.handleChange1} />
                    </div>
                    <div className = "form-group">
                        <label>Style time Taken</label>
                        <input type="text" className="form-control" value={this.state.time_taken} onChange={this.handleChange2} />
                    </div>
                    <div className = "form-group">
                        <button className="btn btn-primary">update</button>
                    </div>
                </form>
            </div>
        );
    }
}
export default EditStyle;
