import React from 'react';
import {
  List,
  Datagrid,
  TextField,
  ReferenceField,
  EditButton,
  ShowButton,
  Filter,
  ReferenceInput,
  SelectInput,
  TextInput,
  SimpleList,
  Responsive,
  RichTextField,
  DeleteButton,
} from 'react-admin';

const NewsFilter = props => (
  <Filter {...props}>
    <TextInput label="Search" source="q" alwaysOn />
  </Filter>
);


const NewsList = props => (
  <List filters={<NewsFilter />} {...props}>
    <Responsive
      small={(
        <SimpleList
          primaryText={record => record.title}
          secondaryText={record => `${record.views} views`}
          tertiaryText={record => new Date(record.published_at).toLocaleDateString()}
        />
)}
      medium={(
        <Datagrid>
          <TextField source="title" />
          <TextField source="createdAt" />
          <EditButton />
          <ShowButton />
          <DeleteButton />
        </Datagrid>
)}
        />
  </List>
);

export default NewsList;
