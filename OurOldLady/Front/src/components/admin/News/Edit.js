import React from 'react';
import {
  Edit,
  SimpleForm,
  TextInput,
} from 'react-admin';
import RichTextInput from 'ra-input-rich-text';

const NewsTitle = ({ record }) => {
  return <span>Post {record ? `"${record.title}"` : ''}</span>;
};


const NewsEdit = props => (
  <Edit title={<NewsTitle />} {...props}>
    <SimpleForm>
      <TextInput source="id" />
      <TextInput source="title" />
      <RichTextInput source="content" />
    </SimpleForm>
  </Edit>
);

export default NewsEdit;
