var messageTypes = $('#user-message').data('type');
var defaultData = $('#user-message').data('default');
var Message = React.createClass({
    render: function () {
        switch (this.props.type) {
            case messageTypes['match_start']:
                return (
                    <li className={"message" + ' read-' + this.props.read} id={this.props.id}>
                        <a className={' read-' + this.props.read} href={'/matches/' + this.props.target}>
                            <span className="image">
                                <img src={defaultData}/>
                            </span>
                            <span className="message-content">
                                {this.props.children.toString()}
                            </span>
                        </a>
                    </li>
                );
            case messageTypes['match_end']:
                return;
            case messageTypes['user_bet']:
                return (
                    <li className={'message read-' + this.props.read} id={this.props.id}>
                        <a className={'read-' + this.props.read} href={'/matches/' + this.props.target}>
                            <span className="image">
                                <img src={defaultData}/>
                            </span>
                            <span className="message-content">
                                {this.props.children.toString()}
                            </span>
                        </a>
                    </li>
                );
            case messageTypes['user_event']:
                return (
                    <li className={'message read-' + this.props.read} id={this.props.id}>
                        <a className={'read-' + this.props.read} href="/home">
                            <span className="image">
                                <img src={defaultData}/>
                            </span>
                            <span className="message-content">
                                {this.props.children.toString()}
                            </span>
                        </a>
                    </li>
                );
        }
    }
});

var messages = $('#user-message').data('messages');
var MessageBox = React.createClass({
    getMessages: function () {
        $.ajax({
            type: 'GET',
            url: this.props.url,
            cache: false,
            success: function (data, status) {
                this.setState({data: data.messages, number: data.user.unread_message_number});
            }.bind(this)
        });
    },
    getInitialState() {
        return {data: []}
    },
    componentDidMount: function () {
        //call automatically after a component is rendered.
        this.getMessages();
        setInterval(this.getMessages, this.props.pollInterval);
    },
    render: function () {
        return (
            <div className='messageBox'>
                <MessageList data={this.state.data} number={this.state.number}/>
            </div>
        )
    }
});

var MessageList = React.createClass({
    render: function () {
        if (this.props.data.length == 0) {
            return false;
        }

        var messageNodes = this.props.data.map(function (message) {
            return (
                <Message key={message.id} id={message.id} type={message.type}
                    target={message.target} read={message.read}
                >
                    {message.content}
                </Message>
            )
        });
        var unreadMessageNumber = this.props.number;
        return (
            <div className="messageList">
                <a href="javascript:;" className="dropdown-toggle info-number" data-toggle="dropdown"
                   aria-expanded="false">
                    <i className="fa fa-envelope-o"></i>
                    <span className="badge bg-green">
                        {unreadMessageNumber}
                    </span>
                </a>
                <ul classId="menu1" className="messageNodes dropdown-menu list-unstyled msg_list" role="menu">
                    {messageNodes}
                </ul>
            </div>
        )
    }
});

var url = $('#user-message').data('url');
var userId = $('#user-message').data('user-id');
var userUrl = $('#user-message').data('user-url');
var unreadMessageNumber = $('#user-message').data('unread-message-number');
ReactDOM.render(
    <MessageBox url={url} pollInterval={5000} userId={userId} unreadMessageNumber={unreadMessageNumber}/>,
    document.getElementById('user-message')
);

$('#user-message').click(function () {
    $(this).find('span.badge').text(0);
    var updatedData = {'unread_message_number': 0};
    $.ajax({
        type: 'PUT',
        url: userUrl,
        data: {data: updatedData},
        success: function (data, status) {
        }
    });
});

$('#user-message').on('click', '.messageNodes li', function (event) {
    event.preventDefault();
    var updatedData = {'read': 1};
    var messageId = $(this).attr('id');
    var url = $(this).find('a').attr('href');
    $.ajax({
        type: 'PUT',
        url: '/ajax-messages/' + messageId,
        data: {data: updatedData},
        success: function (data, status) {
            window.location.href = url;
        }
    });

});
