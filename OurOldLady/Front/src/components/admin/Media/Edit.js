import React from 'react';
import {
  Edit,
  SimpleForm,
  TextInput,

 
} from 'react-admin';
import RichTextInput from 'ra-input-rich-text';

const MediaTitle = ({ record }) => {
  return <span>Post {record ? `"${record.title}"` : ''}</span>;
};


const MediaEdit = props => (
  <Edit title={<MediaTitle />} {...props}>
    <SimpleForm>
      <TextInput source="title" />
      <TextInput source="url" />
      <TextInput source="type" />
    </SimpleForm>
  </Edit>
);

export default MediaEdit;
