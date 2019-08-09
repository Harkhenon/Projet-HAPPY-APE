import React from 'react';
import {
  List,
  Datagrid,
  TextField,
  EditButton,
  ShowButton,
  Filter,
  ReferenceInput,
  SelectInput,
  TextInput,
  SimpleList,
  Responsive,
  RichTextField,
} from 'react-admin';

const MediaFilter = props => (
  <Filter {...props}>
    <TextInput label="Search" source="q" alwaysOn />
    <ReferenceInput label="User" source="author" reference="users" allowEmpty>
      <SelectInput optionText="lastname" />
    </ReferenceInput>
  </Filter>
);


const MediaList = props => (
  <List filters={<MediaFilter />} {...props}>
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
          <RichTextField source="content" />
          <TextField source="type" />
          <EditButton />
          <ShowButton />
        </Datagrid>
)}
        />
  </List>
);

export default MediaList;
