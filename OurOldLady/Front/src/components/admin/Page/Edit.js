import React from 'react';
import {
  Edit,
  SimpleForm,
  ReferenceInput,
  TextInput,
  DisabledInput,
  SelectInput,
 
} from 'react-admin';
import RichTextInput from 'ra-input-rich-text';

const PageTitle = ({ record }) => {
  return <span>Post {record ? `"${record.title}"` : ''}</span>;
};


const PageEdit = props => (
  <Edit title={<PageTitle />} {...props}>
    <SimpleForm>
      <DisabledInput source="id" />
      <TextInput source="title" />
      <RichTextInput source="content" />
    </SimpleForm>
  </Edit>
);

export default PageEdit;
