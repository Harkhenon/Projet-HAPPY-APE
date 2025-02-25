import React from 'react';
import {
  Edit,
  SimpleForm,
  TextInput,
} from 'react-admin';
import RichTextInput from 'ra-input-rich-text';

const PrivatePostTitle = ({ record }) => {
  return <span>Post {record ? `"${record.title}"` : ''}</span>;
};


const PrivatePostEdit = props => (
  <Edit title={<PrivatePostTitle />} {...props}>
    <SimpleForm>
      <TextInput source="title" />
      <RichTextInput source="content" />
    </SimpleForm>
  </Edit>
);

export default PrivatePostEdit;
